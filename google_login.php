<?php
session_start();
require_once 'google/google-api-php-client/src/Google_Client.php';
require_once 'google/google-api-php-client/src/contrib/Google_Oauth2Service.php';
require_once 'config.php';
require_once('class.phpmailer.php');
?>
<?php
    function mailIt($id, $from, $place, $feeling) {
        $message = '
            <html>
            <head>
            <title>Your friend wants to teleport with you at Gapelia</title>
            </head>
            <body>
            <p><h3>Greetings from Gapelia.<h3></p>
            <p>Your friend is feeling '. $feeling .' and is at '.$place.'</p>
            <p>Wanna join up? Try <a href="http://www.gapelia.com">Gapelia</a></p>
            <p>Oh! .. and you have to guess who that friend is?</p>
            <p><b>Yours Truely,<br><i>Gapelians</i></b></p>
            </body>
            </html>
            ';
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "yourfriends@gapelia.com";
        $mail->Password = "gapelia@2013";
        $mail->SetFrom('yourfriends@gapelia.com');
        $mail->Subject = "Greetings from Gapelia";
        $mail->Body = $message;
        $mail->AddAddress('rstabhi@gmail.com');
        if(!$mail->Send())
        {
            error_log ("Mailer Error: " . $mail->ErrorInfo);
        }
        else
        {
            error_log ("Message has been sent");
        }
    }
?>
<?php
    $client = new Google_Client();
    $client->setApplicationName("Google UserInfo ");
    // Visit https://code.google.com/apis/console?api=plus to generate your
    // oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
    $client->setClientId('1067801870252.apps.googleusercontent.com');
    $client->setClientSecret('OrQQ5KfQ1A759H_SOded5eYH');
    $client->setRedirectUri('http://www.gapelia.com/google/');
    $client->setDeveloperKey('AIzaSyDnoyGusLMLiP1qRiu746_4NUj6A2b2OZY');
    $oauth2 = new Google_Oauth2Service($client);

    if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
    }

    if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
    }

    if (isset($_REQUEST['logout'])) {
    unset($_SESSION['token']);
    $client->revokeToken();
    }

    if ($client->getAccessToken()) {
        $user = $oauth2->userinfo->get();

        // These fields are currently filtered through the PHP sanitize filters.
        // See http://www.php.net/manual/en/filter.filters.sanitize.php
        $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
        $name = $user['name'];
        $id = $user['id'];
        $user_profile_string = print_r($user, true);
        error_log($user_profile_string);


        // The access token may have been updated lazily.
        $_SESSION['token'] = $client->getAccessToken();


        // Get DB connection
        $mod = 'gapelia';
        $serv = 'localhost';
        $user = 'ruben';
        $back = 'ping';
        $wrd = 'gapeliano';
        $by = 'adwao.com';

        $con = mysql_connect ( $serv, $user, $wrd ); 
        mysql_select_db ( $mod );

        // Get cookie details
        $place = $_COOKIE['place'];
        $feeling = $_COOKIE['feeling'];
        $with = $_COOKIE['with'];
        $coord = $_COOKIE['coord'];

        try {
            // Save to DB
            $sql="SELECT name, gap_key FROM users2 WHERE ext_key = '" . $id .  "'";
            //error_log($sql);
            $result = mysql_query ( $sql, $con );
            $fetch = mysql_fetch_assoc ( $result );

            if ($fetch=='') { // IF NO USER, INSERT NEW USER
                $gapKey= uniqid();
                $sql="INSERT INTO users2 
                    SET email = '" . $email . "',
                        gap_key = '" . $gapKey . "',
                        ext_key = '" . $id . "',
                        name = '" . utf8_decode($name) . "',
                        raw = '" . $user_profile_string . "' ";

                $result = mysql_query ( $sql, $con );
            } else {
                $gapKey = $fetch['gap_key'];
            }

            $sql = "INSERT INTO raw_data2 SET place = '". $place ."', 
                        gap_key = '". $gapKey ."', 
                        coords = '". $coord . "', 
                        feeling = '". $feeling ."', 
                        with_whom = '". $with . "' ";
            $result = mysql_query ( $sql, $con );
        } catch (Exception $e) {
            error_log($e);
        }

        // Set some new cookies
        setcookie('gapKey', $gapKey, time() + (86400 * 365), "/"); // 86400 = 1 day
        setcookie('name', $name, time() + (86400 * 365), "/");

        // Mail
        $filterWith = filter_var( $with, FILTER_VALIDATE_EMAIL );
        if ($filterWith !== false) {
            mailIt($filterWith, $email, $place, $feeling);
        }

        // Redirect to map now
        header("Location: http://www.gapelia.com/gapelian/map/");
    } else {
    $authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    }
?>
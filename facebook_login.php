<?php
    require 'facebook/src/facebook.php';
    require 'config.php';
    require 'gmail_mail.php';

    $facebook = new Facebook(array(
        'appId'  => '578454235517060',
        'secret' => '80f5c41062211b34019cc379abadda18',
    ));

    // Get User ID
    $user = $facebook->getUser();

    if ($user) {
        try {
            $user_profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
            // Oh snap! We don't know whats wrong here
            error_log($e);
            $user = null;
            header("Location: http://www.gapelia.com/");
        }
    }

    if ($user) {
        // Just another place to get user details ;)
        $user_profile_string = print_r($user_profile, true);
        error_log($user_profile_string);

        // Get user details
        $email = $user_profile['email'];
        $id = $user_profile['id'];
        $name = $user_profile['name'];
        $given_name = $user_profile['first_name'];

        // Get DB connection
        $con = mysql_connect ( SERV, USER, WRD ); 
        mysql_select_db ( MOD );

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
                        given_name = '" . utf8_decode($given_name) ."',
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
        setcookie('name', $given_name, time() + (86400 * 365), "/");

        // Mail
        $filterWith = filter_var( $with, FILTER_VALIDATE_EMAIL );
        if ($filterWith !== false) {
            mailIt($filterWith, $email, $place, $feeling, $given_name);
        }

        // Redirect to map now
        header("Location: http://www.gapelia.com/gapelian/map/");


    } else {
        $loginUrl = $facebook->getLoginUrl();
        header("Location: ".$loginUrl);
    }
?>
<?php
    //require ("/root/pear/share/pear/Mail.php");
    //require("class.phpmailer.php");
    
    function mailIt($to, $from, $place, $feeling) {
        
    }
    function mailIt1($to, $from, $place, $feeling) {
        $message = '
            <html>
            <head>
            <title>Your friend wants to teleport with you at Gapelia</title>
            </head>
            <body>
            <p><h3>Greetings from Gapelia.<h3></p>
            <p>Your friend is feeling $feeling and is at $place</p>
            <p>Wanna join up? Try <a href="http://www.gapelia.com">Gapelia</a></p>
            <p>Oh! .. and you have to guess who it is?</p>
            </body>
            </html>
            ';
        
        $from     = "yourfriends@gapelia.com";
        $to       = $to;
        $subject  = "Greetings from Gapelia";
        $body     = $message;

        $host     = "ssl://smtp.gmail.com";
        $port     = "465";
        $username = "yourfriends@gapelia.com";  //<> give errors
        $password = "password10!";

        $headers = array(
            'From'    => $from,
            'To'      => $to,
            'Subject' => $subject
        );
        $smtp = Mail::factory('smtp', array(
            'host'     => $host,
            'port'     => $port,
            'auth'     => true,
            'username' => $username,
            'password' => $password
        ));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            error_log($mail->getMessage());
        } else {
            error_log("Message successfully sent!");
        }
    }

    function mailIt2($to, $from, $place, $feeling) {
        error_log("Trying to email");
        $message = '
            <html>
            <head>
            <title>Your friend wants to teleport with you at Gapelia</title>
            </head>
            <body>
            <p><h3>Greetings from Gapelia.<h3></p>
            <p>Your friend is feeling $feeling and is at $place</p>
            <p>Wanna join up? Try <a href="http://www.gapelia.com">Gapelia</a></p>
            <p>Oh! .. and you have to guess who it is?</p>
            </body>
            </html>
            ';
        $mail = new PHPMailer();

        $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPAuth   = true; // SMTP authentication
        $mail->Host       = "smtp.gmail.com"; // SMTP server
        $mail->Port       = 465; // SMTP Port
        $mail->Username   = "yourfriends@gapelia.com"; // SMTP account username
        $mail->Password   = "password10!";        // SMTP account password

        $mail->SetFrom('yourfriends@gapelia.com', 'John Doe'); // FROM
        $mail->AddReplyTo('yourfriends@gapelia.com', 'John Doe'); // Reply TO

        $mail->AddAddress($to, 'Gapelian Friend'); // recipient email

        $mail->Subject    = "Greetings from Gapelia"; // email subject
        $mail->Body       = $message;

        if(!$mail->Send()) {
            error_log ('Mailer error: ' . $mail->ErrorInfo);
        } else {
            error_log ('Message has been sent.');
        }
    }
?>
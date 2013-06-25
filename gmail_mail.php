<?php
    require_once('class.phpmailer.php');
    
    function mailIt($id, $from, $place, $feeling) {
        $message = '
            <html>
            <head>
            <title>Your friend wants to teleport with you at Gapelia</title>
            </head>
            <body>
            <p><h3>Greetings from Gapelia.<h3></p>
            <p>Your friend is feeling '. $feeling .' and is in '.$place.'</p>
            <p>Wanna join up? Try <a href="http://www.gapelia.com">Gapelia</a></p>
            <p>Oh! .. and you have to guess who that friend is!</p>
            <p><b>Yours Truly,<br><i>Gapelians</i></b></p>
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
        $mail->AddAddress($id);
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
<?php
    require_once('class.phpmailer.php');
    
    function mailIt($id, $from, $place, $feeling, $name) {
        $file = file_get_contents('/var/www/html/email.html', FILE_USE_INCLUDE_PATH);
        $message = str_replace("#friend#", $name, $file);
        $message = str_replace("#place#", $place, $message);
        $message = str_replace("#feeling#", $feeling, $message);
       
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
        $mail->SetFrom('yourfriends@gapelia.com', 'Gapelia');
        $mail->Subject = $name." Just Teleported!";
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
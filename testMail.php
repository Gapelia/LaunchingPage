<?php
require_once('class.phpmailer.php');
function mailIt($id, $from, $place, $feeling) {
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
    $mail->Subject = "Test";
    $mail->Body = "hello";
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

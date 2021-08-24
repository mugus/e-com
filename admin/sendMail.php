<?php
require '../PHPMailerAutoload.php';
require '../credentials.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password  THESE ARE FOUND IN CREDENTIALS.PHP
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'PSOMS');
$mail->addAddress($_POST['email']);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional

$mail->addReplyTo(EMAIL);
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'PSOMS ACCOUNT';
$mail->Body    = '<div style="width:300px;height:150px;border:solid 2px greenyellow; text-align: center;justify-content: center;"> <strong>'.$businessName.'</strong>, </br> PSOMS are glad to tell that You have successfully created account on <br><br><b>PSOMS!</b><br><br><p>You will Need this password: <strong>'.$passw.'</strong> and you can change it later</p></div>';
$mail->AltBody = 'Thank you for Choosing Us';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} //else {
//     echo 'Message has been sent';
// }
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\kigotech\vendor\autoload.php';
      
$mail = new PHPMailer(); //$mail->SMTPDebug = 3;      // Enable verbose debug output
$mail->isSMTP();     // Set mailer to use SMTP
$mail->Host = 'rbx103.truehost.cloud ';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   // Enable SMTP authentication
$mail->Username = 'georgekanage@kigotech.co.ke';     // SMTP username
$mail->Password = 'george33133848kanagewebmail';              // SMTP password
$mail->SMTPSecure = 'tls';        // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;      // TCP port to connect to or 25 for non secure
$mail->setFrom('georgekanage@kigotech.co.ke', 'Kigo Tech');
$mail->addAddress($to, $u);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('georgekanage@kigotech.co.ke', 'Information');
//$mail->addCC('monkmchizi97@gmail.com');
//$mail->addBCC('monkmchizi97@gmail.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);            // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $msg;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) { 
   echo 'email_send_failed| ' .$mail->ErrorInfo;
} else { 
   echo 'success|';
}
?>
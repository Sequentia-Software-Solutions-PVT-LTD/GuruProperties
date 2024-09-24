<?php 
include_once('PHPMailer\src\PHPMailer.php') ;
include_once('PHPMailer\src\SMTP.php') ;
include_once('PHPMailer\src\Exception.php') ;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mailTo = 'niranjan@sequentia.co.in';
$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host       = 'mail.seqpro.in';
$mail->SMTPAuth   = true;
$mail->Username   = 'niranjan@seqpro.in';
$mail->Password   = 'YvNMZ4#3A^6t';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;

$mail->setFrom('niranjan@seqpro.in', 'Mailer');
$mail->addAddress($mailTo);

$mail->Subject = 'Mail From SMTP seqpro';
$mail->Body    = 'Hi,
This mail is triggered from SMTP configuration';

$mail->send();
<?php

use PHPMailer\PHPMailer\PHPMailer;

const SMTP_HOST = 'mail.example.com';
const SMTP_PORT = 465;
const SMTP_USER = 'noreply@example.com';
const SMTP_PASS = 'secret';

require './vendor/autoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = SMTP_HOST;
$mail->Port = SMTP_PORT;
$mail->Username = SMTP_USER;
$mail->Password = SMTP_PASS;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->setFrom(SMTP_USER);
$mail->isHTML(true);

return $mail;

<?php

$token = bin2hex(random_bytes(5));
$url = require './_url.php';
$link = $url . '/reset.php?token=' . $token;

try {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('UPDATE `Users` SET `Token` = ? WHERE `Email` = ?');
  $stmt->execute([$token, $_POST['email']]);

  $mail = require './_mail.php';
  $mail->addAddress($_POST['email']);
  $mail->Subject = 'Reset Password';
  $mail->Body = 'Click <a href="' . $link . '">here</a> to reset your password.';
  $mail->send();

  header('Location: signin.php');
} catch (Exception $e) {
  file_put_contents('debug.log', $e->getMessage());
  header('Location: reset.php');
}

<?php

$token = bin2hex(random_bytes(5));
$url = require './_url.php';
$link = $url . '/verify.php?token=' . $token;

try {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('INSERT INTO `Users` (`FirstName`, `LastName`, `Email`, `Password`, `Token`) VALUES (?, ?, ?, ?, ?)');
  $stmt->execute([$_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password1'], $token]);

  $mail = require './_mail.php';
  $mail->addAddress($_POST['email']);
  $mail->Subject = 'New Account';
  $mail->Body = 'Click <a href="' . $link . '">here</a> to verify your account.';
  $mail->send();

  header('Location: signin.php');
} catch (Exception $e) {
  file_put_contents('debug.log', $e->getMessage());
  header('Location: signup.php');
}

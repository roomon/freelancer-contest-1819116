<?php

$token = bin2hex(random_bytes(5));
$pdo = require './_pdo.php';
$stmt = $pdo->prepare('INSERT INTO `Users` (`FirstName`, `LastName`, `Email`, `Password`, `Token`) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([$_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password1'], $token]);

$url = require './_url.php';
$link = $url . '/verify.php?token=' . $token;

$mail = require './_mail.php';
$mail->addAddress($_POST['email']);
$mail->Subject = 'New Account';
$mail->Body = 'Click <a href="' . $link . '">here</a> to verify your account.';
$mail->send();

header('Location: signin.php');

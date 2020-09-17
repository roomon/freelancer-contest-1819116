<?php

$token = bin2hex(random_bytes(5));
$pdo = require './_pdo.php';
$stmt = $pdo->prepare('INSERT INTO `Users` (`FirstName`, `LastName`, `Email`, `Password`, `Token`) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([$_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password1'], $token]);
// send mail
header('Location: signin.php');

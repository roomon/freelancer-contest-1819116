<?php

$token = bin2hex(random_bytes(5));
$pdo = require './_pdo.php';
$stmt = $pdo->prepare('UPDATE `Users` SET `Token` = ? WHERE `Email` = ?');
$stmt->execute([$token, $_POST['email']]);
// send mail
header('Location: signin.php');

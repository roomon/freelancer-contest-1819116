<?php

session_start();

$pdo = require './_pdo.php';
$stmt = $pdo->prepare('SELECT * FROM `Users` WHERE `Email` = ?');
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['Password'] !== $_POST['password']) {
    header('Location: signin.php');
} else {
    $_SESSION['auth'] = $user;
    header('Location: index.php');
}

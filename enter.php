<?php

session_start();

try {
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
} catch (Exception $e) {
  file_put_contents('debug.log', $e->getMessage());
  header('Location: signin.php');
}

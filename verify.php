<?php

if (empty($_GET['token'])) {
  header('Location: signup.php');
} else {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('SELECT `ID` FROM `Users` WHERE `Token` = ?');
  $stmt->execute([$_GET['token']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  unset($stmt);
  $stmt = $pdo->prepare('UPDATE `Users` SET `EmailVerified` = 1, `Token` = NULL WHERE `ID` = ?');
  $stmt->execute([$user['ID']]);
  header('Location: signin.php');
}

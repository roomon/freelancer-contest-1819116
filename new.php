<?php

try {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('SELECT `ID` FROM `Users` WHERE `Token` = ?');
  $stmt->execute([$_POST['token']]);
  $user = $stmt->fetch(\PDO::FETCH_ASSOC);
  unset($stmt);

  $stmt = $pdo->prepare('UPDATE `Users` SET `Password` = ?, `Token` = NULL WHERE `ID` = ?');
  $stmt->execute([$_POST['password1'], $user['ID']]);
  unset($_SESSION['reset']);

  header('Location: signin.php');
} catch (Exception $e) {
  file_put_contents('debug.log', $e->getMessage());
  header('Location: reset.php');
}

<?php
session_start();
if (isset($_SESSION['auth'])) header('Location: index.php');
elseif (empty($_SESSION['reset'])) header('Location: reset.php');
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $pdo = require_once './_pdo.php';
    $stmt = $pdo->prepare('SELECT `ID` FROM `Users` WHERE `Token` = ?');
    $stmt->execute([$_POST['token']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    unset($stmt);

    $stmt = $pdo->prepare('UPDATE `Users` SET `Password` = ?, `Token` = NULL WHERE `ID` = ?');
    $stmt->execute([$_POST['password1'], $user['ID']]);
    unset($_SESSION['reset']);

    header('Location: signin.php');
  } catch (Exception $e) {
    file_put_contents('debug.log', $e->getMessage());
    header('Location: reset.php');
  }
} else {
  $pdo = require_once './_pdo.php';
  $stmt = $pdo->prepare('SELECT `Token` FROM `Users` WHERE `ID` = ?');
  $stmt->execute([$_SESSION['reset']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <?php require_once './_top.php' ?>
  <div class="column is-half">
    <div class="box">
      <figure class="is-flex mb-3" style="justify-content: center;">
        <img src="logo.png">
      </figure>
      <form action="password.php" method="post">
        <input type="hidden" name="token" value="<?= $user['Token'] ?>">
        <div class="field">
          <!-- <label for="password1" class="label">New Password</label> -->
          <div class="control has-icons-left">
            <input type="password" class="input is-medium" id="password1" name="password1" placeholder="New Password">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <!-- <label for="password2" class="label">Verify New Password</label> -->
          <div class="control has-icons-left">
            <input type="password" class="input is-medium" id="password2" name="password2" placeholder="Verify New Password">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <button class="button is-primary is-fullwidth">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <?php require_once './_bot.php' ?>
<?php } ?>
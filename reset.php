<?php
session_start();
if (isset($_SESSION['auth'])) header('Location: index.php');
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
} elseif (isset($_GET['token'])) {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('SELECT `ID` FROM `Users` WHERE `Token` = ?');
  $stmt->execute([$_GET['token']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['reset'] = $user['ID'];
  header('Location: password.php');
} else {
?>
  <?php require_once './_top.php' ?>
  <div class="column is-half">
    <div class="box">
      <figure class="is-flex mb-3" style="justify-content: center;">
        <img src="logo.png">
      </figure>
      <form action="reset.php" method="post">
        <div class="field">
          <!-- <label for="email" class="label">Email</label> -->
          <div class="control has-icons-left">
            <input type="email" class="input is-medium" id="email" name="email" placeholder="Email">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <button class="button is-primary is-fullwidth">Submit</button>
        </div>
        <div class="field is-grouped is-grouped-centered">
          <div class="control">
            Have account?
            <a href="/signin">Sign In</a>.
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php require_once './_bot.php' ?>
<?php } ?>
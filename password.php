<?php require_once './_top.php' ?>
<?php
if (isset($_SESSION['auth'])) header('Location: index.php');
elseif (empty($_SESSION['reset'])) header('Location: reset.php');
else {
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('SELECT `Token` FROM `Users` WHERE `ID` = ?');
  $stmt->execute([$_SESSION['reset']]);
  $user = $stmt->fetch(\PDO::FETCH_ASSOC);
}
?>
<div class="column is-half">
  <div class="box">
    <h1 class="title has-text-centered">Change Password</h1>
    <form action="new.php" method="post">
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
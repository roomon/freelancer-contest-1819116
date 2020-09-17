<?php require_once './_top.php' ?>
<?php if (isset($_SESSION['auth'])) header('Location: index.php'); ?>
<?php if (isset($_GET['token'])) : ?>
  <?php
  $pdo = require './_pdo.php';
  $stmt = $pdo->prepare('SELECT `ID` FROM `Users` WHERE `Token` = ?');
  $stmt->execute([$_GET['token']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['reset'] = $user['ID'];
  header('Location: password.php');
  ?>
<?php else : ?>
  <div class="column is-half">
    <div class="box">
      <h1 class="title has-text-centered">Reset</h1>
      <form action="again.php" method="post">
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
<?php endif ?>
<?php require_once './_bot.php' ?>
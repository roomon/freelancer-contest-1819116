<?php
session_start();
if (isset($_SESSION['auth'])) header('Location: index.php');
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token = bin2hex(random_bytes(5));
  $url = require_once './_url.php';
  $link = $url . '/verify.php?token=' . $token;

  try {
    $pdo = require_once './_pdo.php';
    $stmt = $pdo->prepare('INSERT INTO `Users` (`FirstName`, `LastName`, `Email`, `Password`, `Token`) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password1'], $token]);

    $mail = require_once './_mail.php';
    $mail->addAddress($_POST['email']);
    $mail->Subject = 'New Account';
    $mail->Body = 'Click <a href="' . $link . '">here</a> to verify your account.';
    $mail->send();

    header('Location: signin.php');
  } catch (Exception $e) {
    file_put_contents('debug.log', $e->getMessage());
    header('Location: signup.php');
  }
} else {
?>
  <?php require_once './_top.php' ?>
  <div class="column is-half">
    <div class="box">
      <figure class="is-flex mb-3" style="justify-content: center;">
        <img src="logo.png">
      </figure>
      <form action="signup.php" method="post">
        <div class="field">
          <!-- <label for="firstName" class="label">First Name</label> -->
          <div class="control has-icons-left">
            <input type="text" class="input is-medium" id="firstName" name="firstName" placeholder="First Name">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <!-- <label for="lastName" class="label">Last Name</label> -->
          <div class="control has-icons-left">
            <input type="text" class="input is-medium" id="lastName" name="lastName" placeholder="Last Name">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
        </div>
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
          <!-- <label for="password1" class="label">Password</label> -->
          <div class="control has-icons-left">
            <input type="password" class="input is-medium" id="password1" name="password1" placeholder="Password">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <!-- <label for="password2" class="label">Verify Password</label> -->
          <div class="control has-icons-left">
            <input type="password" class="input is-medium" id="password2" name="password2" placeholder="Verify Password">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="agreement">
              I agree to the
              <a href="#">terms and conditions</a>.
            </label>
          </div>
        </div>
        <div class="field">
          <button class="button is-primary is-fullwidth">Submit</button>
        </div>
        <div class="field is-grouped is-grouped-centered">
          <div class="control">
            Have account?
            <a href="signin.php">Sign In</a>.
          </div>
          <div class="control">
            Forgot Password?
            <a href="reset.php">Reset</a>.
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php require_once './_bot.php' ?>
<?php } ?>
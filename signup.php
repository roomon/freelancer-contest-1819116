<?php
session_start();
if (isset($_SESSION['auth'])) header('Location: index.php');
else {
?>
  <?php require_once './_top.php' ?>
  <div class="column is-half">
    <div class="box">
      <figure class="is-flex mb-3" style="justify-content: center;">
        <img src="logo.png">
      </figure>
      <form action="create.php" method="post">
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
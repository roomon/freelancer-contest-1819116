<?php require_once './_top.php' ?>
<?php if (isset($_SESSION['auth'])) header('Location: index.php'); ?>
<div class="column is-half">
  <div class="box">
    <figure class="is-flex mb-3" style="justify-content: center;">
      <img src="logo.png">
    </figure>
    <form action="enter.php" method="post">
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
        <!-- <label for="password" class="label">Password</label> -->
        <div class="control has-icons-left">
          <input type="password" class="input is-medium" id="password" name="password" placeholder="Password">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
        </div>
      </div>
      <div class="field">
        <button class="button is-primary is-fullwidth">Submit</button>
      </div>
      <div class="field is-grouped is-grouped-centered">
        <div class="control">
          No Account?
          <a href="signup.php">Sign Up</a>.
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
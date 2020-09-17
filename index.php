<?php require_once './_top.php' ?>
<div class="column is-half">
  <?php if (isset($_SESSION['auth'])) : ?>
    <h1 class="title has-text-centered">Welcome, <?= $_SESSION['auth']['FirstName'] . ' ' . $_SESSION['auth']['LastName'] ?>!</h1>
  <?php else : ?>
    <h1 class="title has-text-centered">Hello, GUEST!</h1>
  <?php endif ?>
</div>
<?php require_once './_bot.php' ?>
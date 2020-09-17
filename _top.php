<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[Mahmud S.] Freelancer.com Contest#1819116</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body class="has-background-white-ter">
  <main class="hero is-fullheight">
    <section class="hero-head">
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a href="<?= require './_url.php' ?>" class="navbar-item">
            <img src="logo.png">
          </a>
          <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
          <div class="navbar-start">
            <a href="<?= require './_url.php' ?>" class="navbar-item">
              Home
            </a>
          </div>
          <div class="navbar-end">
            <?php if (isset($_SESSION['auth'])) : ?>
              <div class="navbar-item has-dropdown is-hoverable">
                <figure>
                  <img src="myAvatar.png">
                </figure>
                <div class="navbar-dropdown is-right">
                  <a href="signout.php" class="navbar-item has-text-danger">
                    Sign Out
                  </a>
                </div>
              </div>
            <?php else : ?>
              <div class="navbar-item">
                <div class="buttons">
                  <a href="signup.php" class="button is-small is-primary">
                    <strong>Sign Up</strong>
                  </a>
                  <a href="signin.php" class="button is-small is-primary is-outlined">
                    Sign In
                  </a>
                </div>
              </div>
            <?php endif ?>
          </div>
        </div>
      </nav>
    </section>
    <section class="hero-body">
      <div class="container">
        <div class="columns is-centered">
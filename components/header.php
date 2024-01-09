<?php 
session_start();
?>


<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id='navbar'>
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">SocialMedyas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sakila_queries.php">Sakila</a>
        </li>

        <?php 
          if (!$_SESSION['isAuth']) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register.php">Register</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
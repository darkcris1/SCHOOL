<?php
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Divider Template</title>

  <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body style="padding-top: 80px;">

  <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
      <a href="./index.php" class="navbar-brand">
        YesSir
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-md-auto">
          <li class="nav-item">
            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-search"></i>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="header-2">
      <button class="btn btn-primary">Home</button>
      <button class="btn btn-primary">About</button>
      <a href="./contact.php" class="btn btn-primary">Contact</a>
      <button class="btn btn-primary">Categories</button>
    </div>
    <div class="content">
      <div class="d-flex align-items-center justify-content-center">
        <div style="max-width: 500px;" id="carouselExample" data-bs-interval="2500" data-bs-ride="carousel" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img width="100%" height="100%" src="./images/logo.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img width="100%" height="100%" src="./images/logo.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img width="100%" height="100%" src="./images/logo.webp" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="d-flex justify-content-center pt-4">
        <ul>
          <li><a href="./detail.php">Link 1</a></li>
          <li><a href="./detail.php">Link 2</a></li>
          <li><a href="./detail.php">Link 3</a></li>

        </ul>
      </div>
    </div>
    <footer class="d-flex align-items-center justify-content-center">
      Copyright 2023
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>
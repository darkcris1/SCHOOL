<?php
include 'commons/required_login.php';
require_once 'commons/db.php';
// Fetch data from the "post" table with user details

$id = $_GET['user'];
$sql = "SELECT * FROM `users` WHERE `id` = $id LIMIT 1";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/newsfeed.css">
    <title>Newsfeed</title>
</head>

<body >
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark" id='navbar'>
        <div class="container-fluid">
            <a class="navbar-brand" href="/newsfeed.php">SocialMedyas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </button>
            <div class="collapse navbar-collapse flex-grow-0" id="navbarColor01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['displayName'] ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/profile.php?user=<?= $_SESSION['id'] ?>">Profile</a>
                            <a class="dropdown-item" href="/contact.php">Contact</a>
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="col-md-6 mx-auto mt-3 py-5">
            <div class="d-flex align-items-center flex-column">
                <div style="width: 150px;" class="mx-auto">
                    <img class="rounded-circle" src="/uploads/<?= $user['photo'] ?>" width="150" height="150" alt="">
                </div>
                <h2><?= $user['first_name'] ?> <?= $user['last_name'] ?></h2>
            </div>
        </div>
    </div>
</body>

</html>
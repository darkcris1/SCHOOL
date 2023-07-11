<?php
include 'commons/required_login.php';

require_once 'commons/db.php';
// Fetch data from the "post" table with user details
$sql = "SELECT * FROM `contact`";
$sql2 = "SELECT * FROM `users`";
$result = $conn->query($sql);
$userResult = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/newsfeed.css">
    <title>Newsfeed</title>
</head>

<body x-data="Post()">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark" id='navbar'>
        <div class="container-fluid">
            <a class="navbar-brand" href="/newsfeed.php">SocialMedyas</a>
            <div class="flex-grow-1 d-flex align-center justify-content-center">

            </div>
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
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
    
            <div class="col-md-6 mx-auto mt-3 py-5">
                <h2>Contacts</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $result ->fetch_assoc())
                        {
                        ?>
                            <tr>
                                <th scope="row"><?= $row['id']  ?></th>
                                <td><?= $row['email']  ?></td>
                                <td><?= $row['subject']  ?></td>
                                <td><?= $row['message']  ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="col-md-6 mt-3 py-5">
                <h2>Users</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $userResult ->fetch_assoc())
                        {
                        ?>
                            <tr>
                                <th scope="row"><?= $row['id']  ?></th>
                                <td><?= $row['first_name']  ?></td>
                                <td><?= $row['last_name']  ?></td>
                                <td><?= $row['email']  ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    
        </div> -->
    </div>

</body>

</html>
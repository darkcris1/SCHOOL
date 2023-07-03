
<?php
    include 'commons/required_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/newsfeed.css">
    <title>Newsfeed</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark" id='navbar'>
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">SocialMedyas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['displayName'] ?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container py-5">
        <div class="col-md-6 mx-auto mt-3 py-5">
            <div class="social-feed-box">
                <div class="pull-right social-action dropdown">
                    <button data-bs-toggle="dropdown" class="dropdown-toggle btn-white">
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="#">Edit</a></li>
                    </ul>
                </div>
                
                <div class="social-avatar">
                    <a href="" class="pull-left">
                        <img alt="image" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                    </a>
                    <div class="media-body">
                        <a href="#">
                            Andrew Williams
                        </a>
                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                    </div>
                </div>
                <div class="social-body">
                    <p>
                        Lorem Ipsum as their
                        default model text, and a search for 'lorem ipsum' will uncover many web sites still
                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                        default model text.
                    </p>
                    <img src="https://www.bootdey.com/image/650x280/FFB6C1/000000" class="img-responsive">
                    <div class="btn-group">
                        <button class="btn btn-white btn-xs"><i class="far fa-heart me-1"></i>1</button>
                        <button class="btn btn-white btn-xs"><i class="far fa-share me-1"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

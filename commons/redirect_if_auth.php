<?php 
    session_start();

    if ($_SESSION['isAuth']) {
        if ($_SESSION["isAdmin"]) {
            header("Location: admin.php");
        } else {
            header("Location: newsfeed.php");
        }
    }
?>

<?php
    session_start();

    if (!$_SESSION['isAdmin'] && !$_SESSION['isAuth']){
        header('Location: login.php');
    }
?>
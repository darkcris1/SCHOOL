
<?php
    session_start();

    if (!$_SESSION['isAuth']){
        header('Location: login.php');
    }
?>
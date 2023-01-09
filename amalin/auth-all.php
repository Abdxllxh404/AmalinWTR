<?php
    session_start();
    if(!isset($_SESSION['email_acc'])){
        header("Location: auth-login.php");
        exit();
    }
?>
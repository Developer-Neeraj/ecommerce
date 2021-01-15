<?php 
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['username']);
    header("location: login.php");
    die();
?>
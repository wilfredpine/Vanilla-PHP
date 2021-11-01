<?php 
    session_start();
    $_SESSION['username'] = '';
    session_unset();
    header('location:login.php');
?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['fullname']);
    unset($_SESSION['password']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    session_destroy();
    header('location: login.php');
    exit();
}
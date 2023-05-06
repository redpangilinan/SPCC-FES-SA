<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['fullname']);
    unset($_SESSION['password']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    if (isset($_SESSION['student_id'])) {
        unset($_SESSION['student_id']);
    }
    if (isset($_SESSION)) {
        session_destroy();
    }
    header('location: ../../index.php');
    exit();
}

<?php
if (
    isset($_SESSION['email']) &&
    isset($_SESSION['fullname']) &&
    isset($_SESSION['password']) &&
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_type'])
) {
    if ($_SESSION['user_type'] == 'faculty') {
        header("Location: ./faculty.php");
        exit;
    } elseif ($_SESSION['user_type'] == 'student') {
        header("Location: ./student.php");
        exit;
    } elseif ($_SESSION['user_type'] == 'admin') {
        header("Location: ./dashboard.php");
        exit;
    } else {
        unset($_SESSION['email']);
        unset($_SESSION['fullname']);
        unset($_SESSION['password']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);

        header("Location: ./login.php");
        exit;
    }
}

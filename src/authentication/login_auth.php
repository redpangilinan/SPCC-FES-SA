<?php
require "../../config/connection.php";

// Login process
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, student_id, user_type, email, firstname, lastname, password FROM tb_users WHERE email = ?");
    $stmt->execute([$email]);

    if ($row = $stmt->fetch()) {
        // Verify hashed password for login then set every session and cookies if data is correct
        if (password_verify($password, $row['password'])) {
            // Set session values
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = "{$row['firstname']} {$row['lastname']}";
            $_SESSION['password'] = $row['password'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];

            // Redirect users based on their user_type
            if ($row['user_type'] == 'faculty') {
                header("Location: ./faculty.php");
                exit;
            } elseif ($row['user_type'] == 'student') {
                $_SESSION['student_id'] = $row['student_id'];
                header("Location: ./student.php");
                exit;
            } elseif ($row['user_type'] == 'admin') {
                header("Location: ./dashboard.php");
                exit;
            } else {
                unset($_SESSION['email']);
                unset($_SESSION['fullname']);
                unset($_SESSION['password']);
                unset($_SESSION['user_id']);
                unset($_SESSION['user_type']);
                if (isset($_SESSION['student_id'])) {
                    unset($_SESSION['student_id']);
                }

                header("Location: ./login.php");
                exit;
            }
        } else {
            echo 'Your Email or Password is incorrect!';
        }
    } else {
        echo 'Your Email or Password is incorrect!';
    }

    $stmt = null;
    $conn = null;
}

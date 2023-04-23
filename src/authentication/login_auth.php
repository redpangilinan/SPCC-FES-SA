<?php
require "../../config/connection.php";

// Login process
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, user_type, email, firstname, lastname, password FROM tb_users WHERE email = ?");
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

            header("Location: ./dashboard.php");
            exit;
        } else {
            echo 'Your Email or Password is incorrect!';
        }
    } else {
        echo 'Your Email or Password is incorrect!';
    }

    $stmt = null;
    $conn = null;
}
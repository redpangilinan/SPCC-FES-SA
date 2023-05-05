<?php
require "../../../config/connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Store input values into variables
$user_type = "student";
$email = $_SESSION['verify_email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$verification_input = $_POST['verification_code'];
$verification_code = $_SESSION['verification_code'];

$stmt = $conn->prepare('SELECT student_id, firstname, lastname FROM tb_students WHERE email = :email');
$stmt->bindParam(':email', $email);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $student_id = $row['student_id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];

    // Validate verification code
    $valid = false;
    if ($verification_input == $verification_code) {
        $valid = true;
    } else {
        echo "invalid_verification_code";
        exit();
    }

    // Sanitize the user input before inserting record
    if ($valid) {
        if ($password == $confirm_password) {
            include "../../helpers/password_validation.php";
            if (validatePassword($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO tb_users (student_id, user_type, email, password, firstname, lastname) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$student_id, $user_type, $email, $hashed_password, $firstname, $lastname])) {
                    $stmt = $conn->prepare("DELETE FROM tb_verification WHERE email = ? AND verification_code = ?");
                    $stmt->execute([$email, $verification_code]);
                    unset($_SESSION['verify_email']);
                    unset($_SESSION['verification_code']);
                    echo "success";
                    exit();
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                    exit();
                }
            } else {
                echo "weak_password";
                exit();
            }
        } else {
            echo "password_mismatch";
            exit();
        }
    }

    $stmt = null;
    $conn = null;
} else {
    echo "invalid_email";
}

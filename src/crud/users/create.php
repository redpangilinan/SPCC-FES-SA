<?php
require "../../../config/connection.php";

// Store input values into variables
$user_type = $_POST['user_type'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$activation_code = $_POST['activation_code'];
$verification_code = $_POST['verification_code'];

// Extract first and last name from email
list($username, $domain) = explode('@', $email);
$name_parts = explode('.', $username);
$lastname = strtoupper(array_shift($name_parts));
$firstname = implode(' ', array_map('strtoupper', $name_parts));

// Validate user privilege
$valid = false;
if ($user_type == "student") {
    $valid = true;
} else {
    $stmt = $conn->prepare('SELECT activation_code FROM tb_activation_codes WHERE activation_type = ?');
    $stmt->execute([$user_type]);
    $confirm_activation_code = $stmt->fetchColumn();
    if ($activation_code == $confirm_activation_code) {
        $valid = true;
    } else {
        echo "invalid_activation_code";
    }
}

// Sanitize the user input before inserting record
if ($valid) {
    if ($password == $confirm_password) {
        include "../../helpers/password_validation.php";
        if (validatePassword($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO tb_users (user_type, email, password, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$user_type, $email, $hashed_password, $firstname, $lastname])) {
                $stmt = $conn->prepare("DELETE FROM tb_verification WHERE email = ? AND verification_code = ?");
                $stmt->execute([$email, $verification_code]);
                echo "success";
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            echo "weak_password";
        }
    } else {
        echo "password_mismatch";
    }
}

$stmt = null;
$conn = null;

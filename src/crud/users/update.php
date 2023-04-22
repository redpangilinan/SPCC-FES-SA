<?php
require "../../../config/connection.php";

// Store input values into variables
$primary_id = $_POST['primary_id'];
$edit_password = $_POST['edit_password'];
$edit_confirm_password = $_POST['edit_confirm_password'];

// Sanitize the user input before updating record
if ($edit_password == $edit_confirm_password) {
    include "../../helpers/password_validation.php";
    if (validatePassword($edit_password)) {
        $hashed_password = password_hash($edit_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE tb_users SET password=? WHERE user_id=?");
        if ($stmt->execute([$hashed_password, $primary_id])) {
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

$stmt = null;
$conn = null;

<?php
require "../../../config/connection.php";

// Store input values into variables
$faculty_code = $_POST['faculty_code'];
$admin_code = $_POST['admin_code'];

// Sanitize the user input before updating record
$updated = false;

$stmt = $conn->prepare("UPDATE tb_activation_codes SET activation_code=? WHERE activation_type='faculty'");
if ($stmt->execute([$faculty_code])) {
    $updated = true;
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = $conn->prepare("UPDATE tb_activation_codes SET activation_code=? WHERE activation_type='admin'");
if ($stmt->execute([$admin_code])) {
    $updated = true;
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

if ($updated) {
    echo "success";
}

$stmt = null;
$conn = null;

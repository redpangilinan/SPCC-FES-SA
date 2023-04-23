<?php
require "../../../config/connection.php";

// Store input values into variables
$api_key = $_POST['api_key'];

// Sanitize the user input before updating record
$stmt = $conn->prepare("UPDATE tb_api_keys SET key_value=? WHERE api_id=1");
if ($stmt->execute([$api_key])) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = null;
$conn = null;

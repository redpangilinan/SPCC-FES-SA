<?php
require "../../../config/connection.php";

// Store input values into variables
$category_id = $_POST['category_id'];
$question = $_POST['question'];

// Sanitize the user input before inserting record
$stmt = $conn->prepare("INSERT INTO tb_questions (category_id, question) VALUES (?, ?)");
if ($stmt->execute([$category_id, $question])) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = null;
$conn = null;

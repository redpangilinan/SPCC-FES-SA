<?php
require "../../../config/connection.php";

// Store input values into variables
$primary_id = $_POST['primary_id'];
$edit_category_id = $_POST['edit_category_id'];
$edit_question = $_POST['edit_question'];

// Sanitize the user input before updating record
$stmt = $conn->prepare("UPDATE tb_questions SET category_id=?, question=? WHERE question_id=?");
if ($stmt->execute([$edit_category_id, $edit_question, $primary_id])) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = null;
$conn = null;

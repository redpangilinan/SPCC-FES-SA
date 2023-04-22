<?php
require "../../../config/connection.php";

$primary_id = $_POST['delete_id'];
$stmt = $conn->prepare("DELETE FROM tb_questions WHERE question_id = ?");
if ($stmt->execute([$primary_id])) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
$stmt = null;
$conn = null;

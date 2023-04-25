<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "../../../config/connection.php";

// Store input values into variables
$evalEvaluationId = $_POST['evalEvaluationId'];
$evalStudentId = $_SESSION['user_id'];
$evalComment = $_POST['evalComment'];
$evalRating = $_POST['evalRating'];
$evaluationData = $_POST['evaluationData'];

// Sanitize the user input before inserting record
$stmt = $conn->prepare("SELECT report_id FROM tb_reports WHERE student_id = :student_id AND evaluation_id = :evaluation_id");
$stmt->bindParam(":student_id", $evalStudentId);
$stmt->bindParam(":evaluation_id", $evalEvaluationId);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    echo "already_evaluated";
} else {
    $stmt = $conn->prepare("INSERT INTO tb_reports (evaluation_id, student_id, rating, comment, responses, sentiment) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$evalEvaluationId, $evalStudentId, $evalRating, $evalComment, $evaluationData, 'N/A'])) {
        echo "success";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$stmt = null;
$conn = null;

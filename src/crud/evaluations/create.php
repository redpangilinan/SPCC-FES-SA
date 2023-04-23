<?php
require "../../../config/connection.php";

// Store input values into variables
$faculty_id = $_POST['faculty_id'];
$school_year = $_POST['school_year'];
$semester = $_POST['semester'];
$access_code = bin2hex(random_bytes(6));

// Validate evaluation record before inserting
$query = "SELECT access_code FROM tb_evaluations WHERE faculty_id = ? AND school_year = ? AND semester = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$faculty_id, $school_year, $semester]);

// Check if the result exists
if ($stmt->rowCount() > 0) {
    echo "evaluation_already_exists";
} else {
    $stmt = $conn->prepare("INSERT INTO tb_evaluations (faculty_id, school_year, semester, access_code) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$faculty_id, $school_year, $semester, $access_code])) {
        echo "success";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$stmt = null;
$conn = null;

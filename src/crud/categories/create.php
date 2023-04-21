<?php
require "../../../config/connection.php";

$category = $_POST['category'];
$weight = $_POST['weight'];

// Get the total weight of all categories
$stmt = $conn->prepare("SELECT SUM(weight) AS total_weight FROM tb_categories");
$stmt->execute();
$total_weight = $stmt->fetchColumn();

// Check if the total weight will exceed 100 after adding the new category
if ($total_weight + $weight > 100) {
    echo "exceed_weight";
} else {
    // Insert the new category
    $stmt = $conn->prepare("INSERT INTO tb_categories VALUES (null, ?, ?)");
    if ($stmt->execute([$category, $weight])) {
        echo "success";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$stmt = null;
$conn = null;

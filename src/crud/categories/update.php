<?php
require "../../../config/connection.php";

// Store input values into variables
$primary_id = $_POST['primary_id'];
$edit_category = $_POST['edit_category'];
$edit_weight = $_POST['edit_weight'];

// Get the total weight of all categories, excluding the weight of the category being edited
$stmt = $conn->prepare("SELECT SUM(weight) AS total_weight FROM tb_categories WHERE category_id <> ?");
$stmt->execute([$primary_id]);
$total_weight = $stmt->fetchColumn();

// Check if the total weight will exceed 100 after updating the category
if ($total_weight + $edit_weight > 100) {
    echo "exceed_weight";
} else {
    // Sanitize the user input before updating record
    $stmt = $conn->prepare("UPDATE tb_categories SET category=?, weight=? WHERE category_id=?");
    if ($stmt->execute([$edit_category, $edit_weight, $primary_id])) {
        echo "success";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$stmt = null;
$conn = null;

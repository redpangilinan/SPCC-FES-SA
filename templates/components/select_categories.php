<?php
require "../../config/connection.php";

$stmt = $conn->prepare("SELECT category_id, category FROM tb_categories ORDER BY category_id");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category_id = $row['category_id'];
    $category = $row['category'];
    $selected = '';
    if ($select_id == $category_id) {
        $selected = 'selected';
    }
    echo "<option value='$category_id' $selected>$category</option>";
}

$conn = null;

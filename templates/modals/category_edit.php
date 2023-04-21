<?php
include '../../config/connection.php';
$primary_id = $_POST["primary_id"];

$sql = "SELECT category, weight FROM tb_categories WHERE category_id = :primary_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':primary_id', $primary_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">
<div class="mb-3">
    <label for="edit_category" class="form-label">Category</label>
    <input type="text" class="form-control" name="edit_category" id="edit_category" placeholder="Category" value="<?php echo $row['category'] ?>" required>
</div>
<div class="mb-3">
    <label for="edit_weight" class="form-label">Weight (%)</label>
    <input type="number" class="form-control" name="edit_weight" id="edit_weight" placeholder="Weight" value="<?php echo $row['weight'] ?>" required>
</div>

<?php
$stmt = null;
$conn = null;
?>
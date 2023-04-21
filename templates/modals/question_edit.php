<?php
include '../../config/connection.php';
$primary_id = $_POST["primary_id"];

$sql =
    "SELECT category_id, question FROM tb_questions WHERE question_id = :primary_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':primary_id', $primary_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">

<div class="mb-3">
    <label for="edit_question" class="form-label">Question</label>
    <textarea class="form-control" name="edit_question" id="edit_question" rows="3" placeholder="Question" required><?php echo $row['question'] ?></textarea>
</div>
<div class="mb-3">
    <label for="edit_category_id" class="form-label">Category</label>
    <select class="form-select" name="edit_category_id" id="edit_category_id" aria-label="Category">
        <?php
        $select_id = $row['category_id'];
        include "../components/select_categories.php"
        ?>
    </select>
</div>

<?php
$stmt = null;
$conn = null;
?>
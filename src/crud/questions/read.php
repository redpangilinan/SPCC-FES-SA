<?php
require "../../../config/connection.php";

$input = $_POST['input'];
$sql = "SELECT q.question_id, q.question, c.category
    FROM tb_questions q
    JOIN tb_categories c ON q.category_id = c.category_id
    WHERE (q.question_id LIKE '{$input}%'
        OR c.category LIKE '{$input}%'
        OR q.question LIKE '{$input}%')
    ORDER BY q.question_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row["question_id"] ?></td>
            <td><?php echo $row["question"] ?></td>
            <td><?php echo $row["category"] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["question_id"] ?>" class="edit-data btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                    <button data-id="<?php echo $row["question_id"] ?>" class="delete-data btn btn-outline-dark"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='4'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;
?>
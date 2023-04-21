<?php
require "../../../config/connection.php";

$input = $_POST['input'];
$sql = "SELECT category_id, category, weight
FROM tb_categories
WHERE (category_id LIKE '{$input}%'
    OR category LIKE '{$input}%'
    OR weight LIKE '{$input}%')
    ORDER BY category_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) { ?>
    <tr>
        <td><?php echo $row["category_id"] ?></td>
        <td><?php echo $row["category"] ?></td>
        <td><?php echo $row["weight"] . "%" ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="modify">
                <button data-id="<?php echo $row["category_id"] ?>" class="edit-data btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                <button data-id="<?php echo $row["category_id"] ?>" class="delete-data btn btn-outline-dark"><i class="fas fa-trash"></i></button>
            </div>
        </td>
    </tr>
<?php
}
$stmt = null;
$conn = null;

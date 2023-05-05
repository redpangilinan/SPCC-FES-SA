<?php
require "../../../config/connection.php";

$input = $_POST['input'];
$sql = "SELECT ROW_NUMBER() OVER (ORDER BY student_id) as row_number, student_id, email, firstname, lastname, section
FROM tb_students
WHERE (student_id LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR section LIKE '{$input}%')
    ORDER BY student_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row["row_number"] ?></td>
            <td><?php echo $row["firstname"] . ' ' . $row["lastname"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["section"] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["student_id"] ?>" class="delete-data btn btn-outline-dark"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;

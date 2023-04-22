<?php
require "../../../config/connection.php";

$input = $_POST['input'];
$sql =
    "SELECT user_id, user_type, email, firstname, lastname, date(created_at) AS date_created
    FROM tb_users
    WHERE (user_id LIKE '{$input}%'
    OR user_type LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR date(created_at) LIKE '{$input}%')
    ORDER BY user_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row["user_id"] ?></td>
            <td><?php echo $row["date_created"] ?></td>
            <td><?php echo $row["firstname"] . " " . $row["lastname"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["user_type"] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["user_id"] ?>" class="edit-data btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                    <button data-id="<?php echo $row["user_id"] ?>" class="delete-data btn btn-outline-dark"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;
?>
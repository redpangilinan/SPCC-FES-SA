<?php
require "../../config/connection.php";

$primary_id = $_POST['primary_id'];
$sql = "SELECT report_id, rating, comment, sentiment FROM tb_reports WHERE evaluation_id = $primary_id ORDER BY rating DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><button data-id="<?php echo $row["report_id"] ?>" class="view-report btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#reportModal"><?php echo $row["rating"] ?></button></td>
            <td><?php echo $row["comment"] ?></td>
            <td><?php echo $row["sentiment"] ?></td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='3'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;
?>
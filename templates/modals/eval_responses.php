<?php
require "../../config/connection.php";

$primary_id = $_POST['primary_id'];
$sql = "SELECT rating, comment, sentiment FROM tb_reports WHERE evaluation_id = $primary_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row["rating"] ?></td>
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
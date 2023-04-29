<?php
require "../../config/connection.php";

$primary_id = $_POST['primary_id'];
$sql =
    "SELECT
        IFNULL(SUM(sentiment = 'Positive'), 0) AS positive, 
        IFNULL(SUM(sentiment = 'Negative'), 0) AS negative,
        IFNULL(SUM(sentiment = 'Neutral'), 0) AS neutral
    FROM tb_reports
    WHERE evaluation_id = $primary_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) { ?>
    <tr>
        <td><?php echo $row["positive"] ?></td>
        <td><?php echo $row["negative"] ?></td>
        <td><?php echo $row["neutral"] ?></td>
    </tr>
<?php
}

$stmt = null;
$conn = null;
?>
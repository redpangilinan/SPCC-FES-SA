<?php
require "../../../config/connection.php";

$input = $_POST['input'];
$schoolYear = $_POST['schoolYear'];
$semester = $_POST['semester'];
$sql =
    "SELECT 
        e.evaluation_id AS evaluation_id, 
        CONCAT(u.firstname, ' ', u.lastname) AS fullname, 
        e.school_year AS school_year, 
        e.semester AS semester, 
        COUNT(DISTINCT r.report_id) AS responses, 
        ROUND(AVG(r.rating), 2) AS average_rating
    FROM 
        tb_evaluations e
        JOIN tb_users u ON e.faculty_id = u.user_id
        LEFT JOIN tb_reports r ON e.evaluation_id = r.evaluation_id
    WHERE (e.school_year = '{$schoolYear}'
        AND ('{$semester}' = 'All' OR e.semester = '{$semester}')) 
        AND (e.evaluation_id LIKE '{$input}%' 
        OR u.firstname LIKE '{$input}%' 
        OR u.lastname LIKE '{$input}%' 
        OR DATE(e.created_at) LIKE '{$input}%' 
        OR r.responses LIKE '{$input}%' 
        OR r.rating LIKE '{$input}%')
    GROUP BY 
        e.evaluation_id, 
        u.firstname, 
        u.lastname, 
        e.school_year, 
        e.semester";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
    foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row["evaluation_id"] ?></td>
            <td><?php echo $row["fullname"] ?></td>
            <td><?php echo $row["school_year"] ?></td>
            <td><?php echo $row["semester"] ?></td>
            <td><?php echo $row["responses"] ?></td>
            <td><?php echo $row["average_rating"] ? $row["average_rating"] : 'N/A'; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["evaluation_id"] ?>" class="delete-data btn btn-outline-dark"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='7'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;
?>
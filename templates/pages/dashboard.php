<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../src/authentication/logout.php';
include "../../src/helpers/get_semester_sy.php";
include '../../src/authentication/authorize.php';
authorize("admin");
$semester_sy = getSemesterSy();
$school_year = $semester_sy['school_year'];
$semester = $semester_sy['semester'];

// Array for dashboard icons
$table_icons = array(
    'tb_users' => array('display_name' => 'Users', 'icon' => 'user'),
    'tb_categories' => array('display_name' => 'Categories', 'icon' => 'folder'),
    'tb_questions' => array('display_name' => 'Questions', 'icon' => 'question-circle'),
    'tb_evaluations' => array('display_name' => 'Evaluations', 'icon' => 'check-square'),
    'tb_reports' => array('display_name' => 'Responses', 'icon' => 'comment-alt'),
);

require '../../config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Dashboard</title>
</head>

<body id="body-pd" class="body-core">
    <?php include '../components/navbar.php' ?>
    <main>
        <div class="my-3 pt-3 container-fluid">
            <h1>Dashboard</h1>
            <hr>
            <div class="col mb-3">
                <div class="card px-4 px-lg-5 py-4">
                    <h4>Welcome, <?php echo $_SESSION['fullname'] ?>!</h4>
                    <div class="card" style="border-left: 3px solid;">
                        <div class="card-body">
                            <h2>Academic Year <?php echo $school_year ?></h2>
                            <h4><?php echo $semester ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-lg row-cols-lg-2">
                <?php
                $stmt = $conn->prepare("
                    SELECT 'tb_users' AS table_name, COUNT(*) AS count FROM tb_users
                    UNION ALL
                    SELECT 'tb_categories' AS table_name, COUNT(*) AS count FROM tb_categories
                    UNION ALL
                    SELECT 'tb_questions' AS table_name, COUNT(*) AS count FROM tb_questions
                    UNION ALL
                    SELECT 'tb_evaluations' AS table_name, COUNT(*) AS count FROM tb_evaluations
                    UNION ALL
                    SELECT 'tb_reports' AS table_name, COUNT(*) AS count FROM tb_reports;
                ");

                if (!$stmt->execute()) {
                    echo 'Failed to execute query: ' . $stmt->errorInfo()[2];
                    exit();
                }

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $table = $table_icons[$row['table_name']];
                    $icon = $table['icon'];
                    $display_name = $table['display_name'];
                    echo '
                    <div class="col mb-2 mb-lg-3">
                        <div class="card p-4 d-flex flex-row justify-content-between">
                            <div>
                                <h1>' . $row['count'] . '</h1>
                                <p>' . $display_name . '</p>
                            </div>
                            <i class="fa-solid fa-' . $icon . ' fa-4x text-secondary"></i>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
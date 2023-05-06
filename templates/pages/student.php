<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../src/authentication/logout.php';
include "../../src/helpers/get_semester_sy.php";
include '../../src/authentication/authorize.php';
authorize("student");
$semester_sy = getSemesterSy();
$school_year = $semester_sy['school_year'];
$semester = $semester_sy['semester'];
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
    <title><?php echo $_SESSION["fullname"] ?></title>
</head>

<body id="body-pd" class="body-core">
    <?php include '../components/navbar.php' ?>
    <main class="container-fluid">
        <div class="my-3 pt-3 overflow-hidden">
            <h1><?php echo $_SESSION["fullname"] ?></h1>
            <hr>
        </div>
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card w-100 mb-4" id="form_add" style="max-width: 30rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;"><?php echo "S.Y $school_year | $semester" ?></span>
                </div>
                <div class="card-body">
                    <form id="evaluation_access_code" action="../verification/validate_access_code.php" method="POST">
                        <label for="access_code" class="form-label">Access Code</label>
                        <input type="text" class="form-control mb-2" name="access_code" id="access_code" placeholder="Access Code" autocomplete="off">
                        <button type="submit" class="btn btn-dark w-100 mt-2" id="start_evaluation_button">Start Evaluation</button>
                    </form>
                    <?php
                    require "../../config/connection.php";

                    // Retrieve the student's section based on their session ID
                    $student_id = $_SESSION["student_id"];
                    $stmt = $conn->prepare("SELECT section FROM tb_students WHERE student_id = :id");
                    $stmt->bindParam(':id', $student_id);
                    $stmt->execute();
                    $section_row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $section = $section_row["section"];

                    // Retrieve evaluations from tb_evaluations table that are permitted for the student's section
                    $stmt = $conn->prepare("SELECT faculty_name, subject, access_code, permit FROM tb_evaluations WHERE school_year = :school_year AND semester = :semester");
                    $stmt->bindParam(':school_year', $school_year);
                    $stmt->bindParam(':semester', $semester);
                    $stmt->execute();
                    $evaluations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Filter the evaluations to only include those that are permitted for the student's section
                    $permitted_evaluations = array();
                    foreach ($evaluations as $evaluation) {
                        $permit_sections = explode(",", $evaluation["permit"]);
                        if (in_array($section, $permit_sections)) {
                            $permitted_evaluations[] = $evaluation;
                        }
                    }

                    // Print the permitted evaluations in a table
                    if (!empty($permitted_evaluations)) {
                        echo "<div class='table-responsive mt-3'>";
                        echo "<table class='table'>";
                        echo "<tr><th>Faculty Name</th><th>Subject</th><th>Access Code</th></tr>";
                        foreach ($permitted_evaluations as $evaluation) {
                            echo "<tr><td>" . $evaluation["faculty_name"] . "</td><td>" . $evaluation["subject"] . "</td><td>" . $evaluation["access_code"] . "</td></tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
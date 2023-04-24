<?php
session_start();
include "../../src/helpers/get_semester_sy.php";
$semester_sy = getSemesterSy();
$current_sy = $semester_sy['school_year'];
$current_semester = $semester_sy['semester'];
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

<body>
    <div class="container-fluid">
        <header class="my-3 overflow-hidden">
            <h1><?php echo $_SESSION["fullname"] ?></h1>
            <hr>
        </header>
        <main class="d-flex justify-content-center align-items-center h-100">
            <div class="card w-100" id="form_add" style="max-width: 30rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;"><?php echo "S.Y $current_sy | $current_semester" ?></span>
                </div>
                <div class="card-body">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $access_code = $_POST['access_code'];

                        require "../../config/connection.php";

                        $stmt = $conn->prepare("SELECT evaluation_id, faculty_id, school_year, semester FROM tb_evaluations WHERE access_code = :access_code");
                        $stmt->bindParam(":access_code", $access_code);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $student_id = $_SESSION['user_id'];
                            $evaluation_id = $result['evaluation_id'];
                            $faculty_id = $result['faculty_id'];
                            $school_year = $result['school_year'];
                            $semester = $result['semester'];

                            if ($school_year == $current_sy && $semester == $current_semester) {
                                $stmt = $conn->prepare("SELECT created_at FROM tb_reports WHERE student_id = :student_id AND evaluation_id = :evaluation_id");
                                $stmt->bindParam(":student_id", $student_id);
                                $stmt->bindParam(":evaluation_id", $evaluation_id);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0) {
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    echo '
                                    <div class="alert alert-success" role="alert">
                                    <h3 class="alert-heading">You have already submitted an evaluation!</h3>
                                    <p>You have already evaluated this particular instructor during this semester.</p>
                                    <hr>
                                    <p>' . $result['created_at'] . '</p>
                                    </div>
                                    <button class="btn btn-dark w-100" onclick="javascript:history.back()">Re-enter access code</button>';
                                } else {
                                    $_SESSION['eval_evaluation_id'] = $evaluation_id;
                                    $_SESSION['eval_faculty_id'] = $faculty_id;
                                    $_SESSION['eval_school_year'] = $school_year;
                                    $_SESSION['eval_semester'] = $semester;

                                    header("Location: ../../templates/pages/student_evaluation.php");
                                    exit;
                                }
                            } else {
                                echo '
                                <div class="alert alert-danger" role="alert">
                                <h3 class="alert-heading">Evaluation has already expired!</h3>
                                <p>The access code you entered are from previous semesters and has already expired.</p>
                                </div>
                                <button class="btn btn-dark w-100" onclick="javascript:history.back()">Re-enter access code</button>';
                            }
                        } else {
                            echo '
                            <div class="alert alert-danger" role="alert">
                            <h3 class="alert-heading">Invalid access code!</h3>
                            <p>Make sure that you enter the proper access code to proceed in the evaluations.</p>
                            </div>
                            <button class="btn btn-dark w-100" onclick="javascript:history.back()">Re-enter access code</button>';
                        }

                        $stmt = null;
                        $conn = null;
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
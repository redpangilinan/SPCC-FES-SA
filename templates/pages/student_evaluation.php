<?php
session_start();
include "../../src/helpers/get_semester_sy.php";
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
    <title>Student Evaluation</title>
</head>

<body>
    <div class="container-fluid">
        <header class="my-3 overflow-hidden">
            <h1>Evaluation</h1>
            <hr>
        </header>
        <main class="d-flex justify-content-center align-items-center h-100">
            <div class="card w-100" id="form_add" style="max-width: 35rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;"><?php echo "S.Y $school_year | $semester" ?></span>
                </div>
                <div class="card-body">
                    Evaluation process WIP
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/copyToClipboard.js"></script>
    <script src="../../public/js/ajax/activateEvaluation.js"></script>
</body>

</html>
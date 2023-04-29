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

<body>
    <div class="container-fluid">
        <header class="my-3 overflow-hidden">
            <h1><?php echo $_SESSION["fullname"] ?></h1>
            <hr>
        </header>
        <main class="d-flex justify-content-center align-items-center h-100">
            <div class="card w-100" id="form_add" style="max-width: 30rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;"><?php echo "S.Y $school_year | $semester" ?></span>
                </div>
                <div class="card-body">
                    <form id="evaluation_access_code" action="../verification/validate_access_code.php" method="POST">
                        <label for="access_code" class="form-label">Access Code</label>
                        <input type="text" class="form-control mb-2" name="access_code" id="access_code" placeholder="Access Code" autocomplete="off">
                        <button type="submit" class="btn btn-dark w-100 mt-2" id="start_evaluation_button">Start Evaluation</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
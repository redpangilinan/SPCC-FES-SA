<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    <title><?php echo $_SESSION["fullname"] ?></title>
</head>

<body>
    <div class="container-fluid">
        <header class="my-3 overflow-hidden">
            <h1><?php echo $_SESSION["fullname"] ?></h1>
            <hr>
        </header>
        <main class="d-flex justify-content-center align-items-center h-100">
            <div class="card w-100" id="form_add" style="max-width: 35rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;"><?php echo "S.Y $school_year | $semester" ?></span>
                </div>
                <div class="card-body">
                    <?php
                    require "../../config/connection.php";
                    $faculty_id = $_SESSION["user_id"];

                    // Prepare the query
                    $query = "SELECT access_code FROM tb_evaluations WHERE faculty_id = ? AND school_year = ? AND semester = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$faculty_id, $school_year, $semester]);

                    // Check if the result exists
                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo '
                        <label for="access_code" class="form-label">Access Code</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="access_code" id="access_code" placeholder="Access Code" value="' . $row['access_code'] . '" readonly>
                            <button type="button" class="btn btn-dark" id="copy_text_button"><i class="fa-solid fa-clipboard"></i></button>
                        </div>';
                    } else {
                        echo '
                        <form id="activate_eval_form">
                            <input type="hidden" name="faculty_id" id="faculty_id" value="' . $_SESSION["user_id"] . '">
                            <input type="hidden" name="school_year" id="school_year" value="' . $school_year . '">
                            <input type="hidden" name="semester" id="semester" value="' . $semester . '">
                            <label for="access_code" class="form-label">Access Code</label>
                            <input type="text" class="form-control mb-2" name="access_code" id="access_code" placeholder="Access Code" value="N/A" readonly>
                            <button type="submit" class="btn btn-dark w-100 mt-2" id="activate_evaluation">Activate Evaluation</button>
                        </form>';
                    }

                    $stmt = null;
                    $conn = null;
                    ?>
                    <p class="text-danger mt-2" role="alert" id="access_msg">Share your access code to your students only. Keep in mind that your access code will expire once the semester is over.</p>
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
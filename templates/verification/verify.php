<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['verify_email']) && !isset($_SESSION['verification_code'])) {
    die("Error: Email and verification code does not exist.");
} else {
    require "../../config/connection.php";
    $stmt = $conn->prepare("SELECT email, verification_code FROM tb_verification WHERE email = :email");
    $stmt->bindParam(":email", $_SESSION['verify_email']);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        die("Error: Email and verification code does not exist.");
    }

    $stmt = null;
    $conn = null;
}
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
    <title>Verify Account</title>
</head>

<body>
    <main class="d-flex justify-content-center align-items-center vh-100">
        <!-- Add Form -->
        <form class="card w-100 mx-2" id="form_add" style="max-width: 25rem; min-width: 19rem;">
            <div class="card-header">
                <span style="font-size: 1.3em;">Activate your account</span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="verification_code" class="form-label">Verification Code</label>
                    <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Verification Code">
                </div>
                <button type="submit" class="add-confirm btn btn-dark w-100 mt-2" id="addButton">Activate Account</button>
            </div>
        </form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/usersData.js"></script>
</body>

</html>
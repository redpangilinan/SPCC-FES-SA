<?php
session_start();

if (!isset($_GET['email']) && !isset($_GET['code'])) {
    die("Error: Email and verification code does not exist.");
} else {
    require "../../config/connection.php";
    $stmt = $conn->prepare("SELECT email, verification_code FROM tb_verification WHERE email = :email AND verification_code = :code");
    $stmt->bindParam(":email", $_GET['email']);
    $stmt->bindParam(":code", $_GET['code']);
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
        <form class="card w-100" id="form_add" style="max-width: 25rem; min-width: 19rem;">
            <div class="card-header">
                <span style="font-size: 1.3em;">Activate your account</span>
            </div>
            <div class="card-body">
                <input type="hidden" name="email" id="email" value="<?php echo $_GET['email'] ?>">
                <input type="hidden" name="verification_code" id="verification_code" value="<?php echo $_GET['code'] ?>">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password" required>
                </div>
                <div class="mb-3 d-flex">
                    <div class="w-100">
                        <label for="user_type" class="form-label">Account:</label>
                        <select class="form-select" name="user_type" id="user_type" aria-label="User Type">
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="w-100 ms-2 d-none" id="accessCodeLayer">
                        <label for="activation_code" class="form-label">Activation Code</label>
                        <input type="password" class="form-control" name="activation_code" id="activation_code" placeholder="Access Code">
                    </div>
                </div>
                <button type="submit" class="add-confirm btn btn-primary w-100 mt-2" id="addButton">Activate Account</button>
            </div>
        </form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/accessCheck.js"></script>
    <script src="../../public/js/ajax/usersData.js"></script>
</body>

</html>
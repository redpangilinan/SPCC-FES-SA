<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../src/authentication/logout.php';
include '../../src/authentication/authorize.php';
authorize("admin");

require "../../config/connection.php";

// Fetch faculty code
$sql = "SELECT activation_code FROM tb_activation_codes WHERE activation_type = 'faculty'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$facultyCode = $stmt->fetchColumn();

// Fetch admin code
$sql = "SELECT activation_code FROM tb_activation_codes WHERE activation_type = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$adminCode = $stmt->fetchColumn();

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
    <title>Settings</title>
</head>

<body>
    <div class="container-fluid">
        <header class="my-3">
            <h1>Settings</h1>
            <hr>
        </header>
        <main class="d-flex justify-content-center align-items-center h-100">
            <!-- Add Form -->
            <div class="card w-100" id="form_add" style="max-width: 25rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;">Settings</span>
                </div>
                <div class="card-body">
                    <form id="activation_form">
                        <h3 class="text-center">Activation Codes</h3>
                        <div class="mb-3">
                            <label for="faculty_code" class="form-label">Faculty</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="faculty_code" id="faculty_code" placeholder="Activation Code" value="<?php echo $facultyCode ?>" autocomplete="off" required>
                                <button type="button" class="btn btn-outline-secondary" id="generate_faculty" data-bs-toggle="tooltip" data-bs-title="Generate new code"><i class="fa-solid fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="admin_code" class="form-label">Admin</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="admin_code" id="admin_code" placeholder="Activation Code" value="<?php echo $adminCode ?>" autocomplete="off" required>
                                <button type="button" class="btn btn-outline-secondary" id="generate_admin" data-bs-toggle="tooltip" data-bs-title="Generate new code"><i class="fa-solid fa-refresh"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-2" id="activation_button">Save changes</button>
                    </form>
                    <hr>
                    <form id="api_form">
                        <h3 class="text-center">API Keys</h3>
                        <div class="mb-3">
                            <label for="api_key" class="form-label">OpenAI API Key</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="api_key" id="api_key" placeholder="API Key" value="" autocomplete="off" required>
                                <button type="submit" class="btn btn-dark" id="api_button"><i class="fa-solid fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/tooltip.js"></script>
    <script src="../../public/js/ajax/settingsData.js"></script>
</body>

</html>
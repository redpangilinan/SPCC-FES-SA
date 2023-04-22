<?php
session_start();
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
    <title>Sign in</title>
</head>

<body>
    <main class="login d-flex justify-content-around align-items-center">
        <div class="d-none d-lg-block" style="max-width: 40rem;">
            <h1 class="mb-4" style="font-size: 4rem; font-weight: 800;">Systems Plus Computer College Caloocan</h1>
            <h3>A leading and globally competitive institution of learning through service and innovation.</h3>
        </div>
        <form class="login-form card p-4 p-lg-5 m-2" action="./login.php" method="post">
            <h1 class="mb-4">Sign In</h1>
            <div class="form-outline mb-2">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control" />
            </div>
            <div class="form-outline mb-2">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" />
            </div>
            <span class="text-center text-danger"><?php include "../../src/authentication/login_auth.php" ?></span>
            <div class="row my-2"></div>
            <button type="submit" class="btn btn-primary btn-block my-2 mb-4 w-100" name="login">Sign in</button>
            <div class="text-center">
                <p>Can't login? <a href="#" data-bs-toggle="modal" data-bs-target="#emailModal">Activate your SPCC account</a></p>
            </div>
        </form>
    </main>

    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="emailModalLabel">Enter your SPCC email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_verify">
                    <div class="modal-body py-5">
                        <label class="form-label" for="verify_email">Email address</label>
                        <input type="email" id="verify_email" name="verify_email" class="form-control" />
                    </div>
                    <span class="text-success" id="verify_text"></span>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="edit-confirm btn btn-primary" id="verifyButton">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/verifyEmail.js"></script>
</body>

</html>
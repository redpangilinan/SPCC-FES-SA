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
        <form class="login-form card p-4 p-lg-5 m-2">
            <h1 class="mb-4">Sign In</h1>
            <div class="form-outline mb-2">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="email" class="form-control" />
            </div>
            <div class="row mb-4">
                <div class="col">
                    <a href="#!">Forgot password?</a>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
            <div class="text-center">
                <p>Not a member? <a href="#!">Activate your SPCC account</a></p>
            </div>
        </form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
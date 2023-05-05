<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../src/authentication/logout.php';
include '../../src/authentication/authorize.php';
authorize("admin");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Student List</title>
</head>

<body id="body-pd" class="body-core">
    <?php include '../components/navbar.php' ?>
    <main>
        <div class="container-fluid my-3 pt-3">
            <h1>Student List</h1>
            <hr>
        </div>
        <div class="container">
            <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
                <div class="w-100">
                    <input type="text" class="form-control mb-2" id="search-data" placeholder="Search">
                    <form class="d-flex flex-row-reverse gap-2" id="csv_form" method="post" enctype="multipart/form-data">
                        <button type="submit" class="add-confirm btn btn-dark mb-2" id="csv_upload">Import</button>
                        <input class="form-control mb-2" type="file" name="file" id="file" style="max-width: 20rem;">
                    </form>
                    <div class="table-responsive">
                        <table class="table bg-white table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data-results">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/studentsData.js"></script>
</body>

</html>
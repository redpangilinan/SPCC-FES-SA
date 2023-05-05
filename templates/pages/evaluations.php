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
    <title>Evaluations</title>
</head>

<body id="body-pd" class="body-core">
    <?php include '../components/navbar.php' ?>
    <main>
        <div class="container-fluid my-3 pt-3">
            <h1>Evaluations</h1>
            <hr>
        </div>
        <div class="container">
            <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
                <div class="w-100">
                    <input type="text" class="form-control mb-2" id="search-data" placeholder="Search">
                    <div class="d-flex flex-row-reverse gap-2">
                        <select class="form-select mb-2" id="filter-semester" aria-label="Category" style="max-width: 15rem;">
                            <option value="All">All</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
                        <select class="form-select mb-2" id="filter-sy" aria-label="Category" style="max-width: 15rem;">
                            <?php include "../components/select_sy.php" ?>
                        </select>
                    </div>
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
                                    <th>Subject</th>
                                    <th>School Year</th>
                                    <th>Semester</th>
                                    <th>Responses</th>
                                    <th>Average Rating</th>
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

    <div class="modal fade" id="responsesModal" tabindex="-1" aria-labelledby="responsesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="responsesModalLabel">Responses</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>Positive</th>
                            <th>Negative</th>
                            <th>Neutral</th>
                        </thead>
                        <tbody id="sentimentCount"></tbody>
                    </table>
                    <table class="table">
                        <thead>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Sentiment</th>
                        </thead>
                        <tbody id="responsesBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reportModalLabel">Response Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reportBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#responsesModal">Back</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/evaluations/evaluationsData.js"></script>
</body>

</html>
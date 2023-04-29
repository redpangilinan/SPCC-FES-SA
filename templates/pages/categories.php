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
    <title>Categories</title>
</head>

<body>
    <div class="container-fluid">
        <header class="my-3">
            <h1>Categories</h1>
            <hr>
        </header>
        <main class="d-flex flex-column flex-lg-row gap-3 mb-4">
            <!-- Add Form -->
            <form class="card align-self-start w-100" id="form_add" style="max-width: 25rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;">Add Category</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Category" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (%)</label>
                        <input type="number" class="form-control" name="weight" id="weight" placeholder="20" required>
                    </div>
                    <button type="submit" class="add-confirm btn btn-dark w-100 mt-2" id="addButton">Add Category</button>
                </div>
            </form>
            <div class="w-100">
                <input type="text" class="form-control mb-2" id="search-data" placeholder="Search">
                <div class="table-responsive">
                    <table class="table bg-white table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Weight</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody id="data-results">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- Edit Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Edit Form -->
                <form id="form_edit">
                    <div class="modal-body" id="editBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="edit-confirm btn btn-primary" id="editButton">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/categoriesData.js"></script>
</body>

</html>
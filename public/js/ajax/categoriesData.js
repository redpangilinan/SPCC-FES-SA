$(document).ready(function () {
    displayTable();
    $("#search-data").keyup(function () {
        displayTable();
    });

    $(document).on("click", ".edit-data", function () {
        // Initialize Skeleton Loader
        $("#editBody").html(`
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        `);
        let primary_id = $(this).data('id');
        displayEdit(primary_id);
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        addBtnDisable();
        const formData = new FormData(this);
        insertData(formData);
    });

    $("#form_edit").submit(function (e) {
        e.preventDefault();
        editBtnDisable();
        const formData = new FormData(this);
        updateData(formData);
    });

    // Show confirmation first before deleting data
    $(document).on("click", ".delete-data", function () {
        let delete_id = $(this).data('id');
        deleteConfirmation(delete_id);
    });

});

// Displays datatable
const displayTable = () => {
    let input = $("#search-data").val();
    $.ajax({
        url: "../../src/crud/categories/read.php",
        method: "POST",
        data: {
            input: input
        },
        success: function (data) {
            $("#data-results").html(data);
        }
    });
}

// Displays data in edit modal
const displayEdit = (primary_id) => {
    $.ajax({
        url: "../modals/category_edit.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $(".modal-body").html(data);
        }
    });
}

// Adds a new data
const insertData = (formData) => {
    $.ajax({
        url: "../../src/crud/categories/create.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            if (data == "success") {
                $('#form_add')[0].reset();
                addBtnEnable();
                customAlert("success", "Success!", "The record has been added successfully!");
            } else if (data == "exceed_weight") {
                addBtnEnable();
                customAlert("error", "Total weight exceeded!", "Make sure the total weight of all categories won't exceed 100%.");
            } else {
                addBtnEnable();
                console.log(data);
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Updates the data
const updateData = (formData) => {
    $.ajax({
        url: "../../src/crud/categories/update.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            editBtnEnable();
            $('#editModal').modal('hide');
            $('#form_edit')[0].reset();
            if (data == "success") {
                customAlert("success", "Success!", "The record has been updated successfully!");
            } else if (data == "exceed_weight") {
                addBtnEnable();
                customAlert("error", "Total weight exceeded!", "Make sure the total weight of all categories won't exceed 100%.");
            } else {
                console.log(data);
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../../src/crud/categories/delete.php",
        method: "POST",
        data: {
            delete_id: delete_id
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                customAlert("success", "Success!", "The record has been deleted successfully!");
            } else {
                console.log(data);
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Button modification
const addBtnDisable = () => {
    document.querySelector("#addButton").innerHTML = "Loading...";
    document.querySelector("#addButton").disabled = true;
}

const addBtnEnable = () => {
    document.querySelector("#addButton").innerHTML = "Add Category";
    document.querySelector("#addButton").disabled = false;
}

const editBtnDisable = () => {
    document.querySelector("#editButton").innerHTML = "Loading...";
    document.querySelector("#editButton").disabled = true;
}

const editBtnEnable = () => {
    document.querySelector("#editButton").innerHTML = "Save changes";
    document.querySelector("#editButton").disabled = false;
}
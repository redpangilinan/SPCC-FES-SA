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
        url: "../../src/crud/users/read.php",
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
        url: "../modals/user_edit.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $("#editBody").html(data);
        }
    });
}

// Adds a new data
const insertData = (formData) => {
    $.ajax({
        url: "../../src/crud/users/create.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data == "success") {
                $('#form_add')[0].reset();
                customAlert("success", "Success!", "Your account has been activated!");
                setTimeout(function () {
                    window.location.href = "../pages/login.php";
                }, 3000);
            } else if (data == "password_mismatch") {
                addBtnEnable();
                customAlert("error", "Password mismatch!", "Please confirm your password properly.");
            } else if (data == "weak_password") {
                addBtnEnable();
                customAlert("error", "Weak password!", "Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.");
            } else if (data == "invalid_activation_code") {
                addBtnEnable();
                customAlert("error", "Invalid activation code!", "The activation code you have entered is incorrect.");
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
        url: "../../src/crud/users/update.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            editBtnEnable();
            if (data == "success") {
                $('#editModal').modal('hide');
                $('#form_edit')[0].reset();
                customAlert("success", "Success!", "The record has been updated successfully!");
            } else if (data == "password_mismatch") {
                customAlert("error", "Password mismatch!", "Please confirm your password properly.");
            } else if (data == "weak_password") {
                customAlert("error", "Weak password!", "Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.");
            } else {
                $('#editModal').modal('hide');
                $('#form_edit')[0].reset();
                console.log(data);
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../../src/crud/users/delete.php",
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
    document.querySelector("#addButton").innerHTML = "Activate Account";
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
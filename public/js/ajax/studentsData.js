$(document).ready(function () {
    displayTable();
    $("#search-data").keyup(function () {
        displayTable();
    });

    $("#csv_form").submit(function (e) {
        e.preventDefault();
        addBtnDisable();
        const formData = new FormData(this);
        importCsv(formData);
    });

    // Show confirmation first before deleting data
    $(document).on("click", ".delete-data", function () {
        let delete_id = $(this).data('id');
        deleteConfirmation(delete_id);
    });

});

// Imports the CSV file to the table
const importCsv = (formData) => {
    $.ajax({
        url: "../../src/crud/students/csv_import.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            $('#csv_form')[0].reset();
            if (data == "success") {
                addBtnEnable();
                console.log(data);
                customAlert("success", "Success!", "CSV file has been imported successfully!");
            } else if (data == "unsupported_file") {
                addBtnEnable();
                console.log(data);
                customAlert("error", "Unsupported File!", "Your file type is unsupported! Please upload a valid CSV file.");
            } else if (data == "invalid_format") {
                addBtnEnable();
                console.log(data);
                customAlert("error", "Invalid CSV Format!", "The CSV column headers should be the following: 'Email, First Name, Last Name, Section'");
            } else {
                addBtnEnable();
                console.log(data);
                customAlert("error", "Duplicate entry!", "Failed to upload duplicate records!");
            }
        }
    });
}

// Displays datatable
const displayTable = () => {
    let input = $("#search-data").val();
    $.ajax({
        url: "../../src/crud/students/read.php",
        method: "POST",
        data: {
            input: input
        },
        success: function (data) {
            $("#data-results").html(data);
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../../src/crud/students/delete.php",
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
    document.querySelector("#csv_upload").innerHTML = "Uploading...";
    document.querySelector("#csv_upload").disabled = true;
}

const addBtnEnable = () => {
    document.querySelector("#csv_upload").innerHTML = "Import";
    document.querySelector("#csv_upload").disabled = false;
}
$(document).ready(function () {
    displayTable();
    $("#search-data").keyup(function () {
        displayTable();
    });
    $('select').change(function () {
        displayTable();
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
    let schoolYear = $("#filter-sy").val();
    let semester = $("#filter-semester").val();
    $.ajax({
        url: "../../src/crud/evaluations/read.php",
        method: "POST",
        data: {
            input: input,
            schoolYear: schoolYear,
            semester: semester
        },
        success: function (data) {
            $("#data-results").html(data);
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../../src/crud/evaluations/delete.php",
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
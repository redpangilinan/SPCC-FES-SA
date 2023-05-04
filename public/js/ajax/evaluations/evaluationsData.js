$(document).ready(function () {
    displayTable();
    $("#search-data").keyup(function () {
        displayTable();
    });
    $('select').change(function () {
        displayTable();
    });

    $(document).on("click", ".view-data", function () {
        // Initialize Skeleton Loader
        $("#responsesBody").html(`
        <tr>
            <td colspan='3'>
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            </td>
        </tr>`);
        let primary_id = $(this).data('id');
        displaySentimentCount(primary_id);
        displayResponses(primary_id);
    });

    $(document).on("click", ".view-report", function () {
        // Initialize Skeleton Loader
        $("#reportBody").html(`
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`);
        let primary_id = $(this).data('id');
        displayReport(primary_id);
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

// Displays evaluation reports and sentiments
const displayResponses = (primary_id) => {
    $.ajax({
        url: "../modals/eval_responses.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $("#responsesBody").html(data);
        }
    });
}

// Displays data in edit modal
const displaySentimentCount = (primary_id) => {
    $.ajax({
        url: "../modals/sentiment_count.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $("#sentimentCount").html(data);
        }
    });
}

// Displays evaluation report data
const displayReport = (primary_id) => {
    $.ajax({
        url: "../modals/report.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $("#reportBody").html(data);
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
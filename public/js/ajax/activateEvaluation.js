$("#activate_eval_form").submit(function (e) {
    e.preventDefault();
    actBtnDisable();
    const formData = new FormData(this);
    createEvaluation(formData);
});

$("#copy_text_button").click(function () {
    copyToClipboard("#access_code");
    this.innerHTML = `<i class="fa-solid fa-check"></i>`;
});

// Create evaluation for the faculty
const createEvaluation = (formData) => {
    $.ajax({
        url: "../../src/crud/evaluations/create.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data == "success") {
                $("#activate_eval_form").html(`
                <div class="alert alert-success" role="alert">
                <h3 class="alert-heading">Your evaluation has been activated successfully!</h3>
                <p>Please refresh or wait for a few seconds to see your access code.</p>
                <hr>
                <p class="mb-0">Please wait... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></p>
                </div>`);
                document.querySelector("#access_msg").remove();
                setTimeout(function () { window.location.reload(); }, 10000);
            } else if (data == "evaluation_already_exists") {
                actBtnEnable();
                console.log(data)
                customAlert("error", "Existing evaluation!", "Your evaluation is already activated! Please refresh the page.");
            } else {
                actBtnEnable();
                console.log(data)
                customAlert("error", "Error!", "There was a conflict creating an access code, please try again.");
            }
        }
    });
}

// Button modification
const actBtnDisable = () => {
    document.querySelector("#activate_evaluation").innerHTML = "Loading...";
    document.querySelector("#activate_evaluation").disabled = true;
}

const actBtnDelete = () => {
    document.querySelector("#activate_evaluation").remove();
}

const actBtnEnable = () => {
    document.querySelector("#activate_evaluation").innerHTML = "Activate Evaluation";
    document.querySelector("#activate_evaluation").disabled = false;
}

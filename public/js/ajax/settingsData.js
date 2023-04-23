$("#activation_form").submit(function (e) {
    e.preventDefault();
    actBtnDisable();
    const formData = new FormData(this);
    updateActivation(formData);
});

$("#api_form").submit(function (e) {
    e.preventDefault();
    apiBtnDisable();
    const formData = new FormData(this);
    updateApi(formData);
});

$(document).on("click", ".delete-data", function () {
    let delete_id = $(this).data('id');
    deleteConfirmation(delete_id);
});

$(document).on("click", "#generate_faculty", function () {
    $("#faculty_code").val(generateActivationCode(8));
});

$(document).on("click", "#generate_admin", function () {
    $("#admin_code").val(generateActivationCode(8));
});

// Update the activation codes
const updateActivation = (formData) => {
    $.ajax({
        url: "../../src/crud/settings/update_activation.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            actBtnEnable();
            if (data == "success") {
                customAlert("success", "Success!", "The activation codes has been updated successfully.");
            } else {
                console.log(data)
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Update the api key
const updateApi = (formData) => {
    $.ajax({
        url: "../../src/crud/settings/update_api.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            apiBtnEnable();
            $('#api_form')[0].reset();
            if (data == "success") {
                customAlert("success", "Success!", "The API key has been updated successfully.");
            } else {
                console.log(data)
                customAlert("error", "Error!", "Your input is invalid, please try something else.");
            }
        }
    });
}

// Button modification
const actBtnDisable = () => {
    document.querySelector("#activation_button").innerHTML = "Loading...";
    document.querySelector("#activation_button").disabled = true;
}

const actBtnEnable = () => {
    document.querySelector("#activation_button").innerHTML = "Save changes";
    document.querySelector("#activation_button").disabled = false;
}

const apiBtnDisable = () => {
    document.querySelector("#api_button").innerHTML =
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden">Loading...</span>`;
    document.querySelector("#api_button").disabled = true;
}

const apiBtnEnable = () => {
    document.querySelector("#api_button").innerHTML = `<i class="fa-solid fa-check"></i>`;
    document.querySelector("#api_button").disabled = false;
}

// Generate a random activation code
const generateActivationCode = (n) => {
    let activationCode = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const length = n;

    for (let i = 0; i < length; i++) {
        activationCode += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    return activationCode;
}
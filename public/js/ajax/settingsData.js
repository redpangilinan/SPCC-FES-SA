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
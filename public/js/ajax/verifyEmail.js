$("#form_verify").submit(function (e) {
    e.preventDefault();
    btnDisable();
    const formData = new FormData(this);
    verify(formData);
});

// Updates the data
const verify = (formData) => {
    $.ajax({
        url: "../../src/authentication/verify_email.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            btnEnable();
            if (data == "success") {
                $('#emailModal').modal('hide');
                $('#form_verify')[0].reset();
                location.href = '../verification/verify.php';
            } else if (data == "existing_user") {
                customAlert("error", "Existing account!", "The email you entered already exists!");
            } else {
                console.log(data)
                customAlert("error", "Already sent!", "The verification is already sent. Please try again later.");
            }
        }
    });
}

// Button modification
const btnDisable = () => {
    document.querySelector("#verifyButton").innerHTML = "Loading...";
    document.querySelector("#verifyButton").disabled = true;
}

const btnEnable = () => {
    document.querySelector("#verifyButton").innerHTML = "Confirm";
    document.querySelector("#verifyButton").disabled = false;
}
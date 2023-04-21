// Creates a custom alert
function customAlert(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    });
}

// Confirm first before deleting data
function deleteConfirmation(delete_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteData(delete_id);
        }
    })
}
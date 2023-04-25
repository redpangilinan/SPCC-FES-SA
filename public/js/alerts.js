// Custom alerts
const customAlert = (icon, title, text, reloadPage = false) => {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    }).then(() => {
        if (reloadPage) {
            location.reload();
        }
    });
}

// Confirm first before deleting data
const deleteConfirmation = (delete_id) => {
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
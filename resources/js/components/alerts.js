

window.jsAlertDeleteConfirm = function (confirmRoute) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2d2d2d',
            cancelButtonColor: 'rgba(255,103,91)',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = confirmRoute;
            }
        })
}
window.jsAlertSuccess = function (message){
    Swal.fire({
        icon: 'success',
        title: 'SUCCESS',
        text: message,
        showConfirmButton: false,
        timer: 1500
    })
    console.log(message);
}
window.jsAlertSuccessHTMLConfirm = function (htmlMessage, confirmRoute){
    Swal.fire({
        icon: 'success',
        title: 'SUCCESS',
        html: htmlMessage,
        showConfirmButton: true,
        confirmButtonColor: '#2d2d2d',
        showCloseButton: false,
        showCancelButton: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = confirmRoute;
        }
    })
    console.log(htmlMessage);
}
window.jsAlertSuccessToast = function (message){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: message
    })
    console.log(message);
}
window.jsAlertError = function (message){
    Swal.fire({
        icon: 'error',
        title: 'ERROR',
        text: message,
    })
    console.log(message);
}







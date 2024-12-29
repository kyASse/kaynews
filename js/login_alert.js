const Swal = require('sweetalert2');

login_alert = () => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username atau password salah!',
        footer: '<a href="#">Why do I have this issue?</a>'
    });
}
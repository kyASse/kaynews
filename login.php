<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(255, 255, 255);
        }
        .login-image {
            object-fit: cover;
            width: 400px;
            height: 400px;
            border-radius: 0.5rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            margin-bottom: 1.5rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .row {
            align-items: center;
        }
    </style>

</head>
<body>
    <div class="container-sm d-flex justify-content-center align-items-center login-container">
        <div class="row">
            <div class="col">
                <img src="img/login-img.jpg" alt="Login Image" class="login-image">
            </div>
            <div class="col">
                <form action="cek_login.php" method="post" class="login-form p-4">
                    <h2 class="text-center">Login</h2>
                    <div class="form-group mb-3">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-custom w-100 mt-3">LOGIN</button>
                    <p class="mt-3 text-center">Belum punya akun? Yuk <a href="registrasi.php">Daftar</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>


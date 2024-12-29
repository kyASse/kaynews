<?php

include_once("config.php");

$errorMessage = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['register'])) {
    $userName = test_input($_POST['username']);
    $userEmail = test_input($_POST['email']);
    $userPassword = md5($_POST['password']);

    if (empty($userName)) {
        $errorMessage = "Username tidak boleh kosong";
    } else if (empty($userEmail)) {
        $errorMessage = "Email tidak boleh kosong";
    } else if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Format email salah";
    } else if (empty($userPassword)) {
        $errorMessage = "Password tidak boleh kosong";
    } else if (strlen($_POST['password']) < 6) {
        $errorMessage = "Password harus memiliki minimal 6 karakter";
    } else if (!preg_match('/[A-Z]/', $_POST['password'])) {
        $errorMessage = "Password harus memiliki minimal satu huruf kapital";
    } else if (!preg_match('/[0-9]/', $_POST['password'])) {
        $errorMessage = "Password harus memiliki minimal satu angka";
    } else {
        $sql = "INSERT INTO users (name, password, email, role) VALUES ('$userName', '$userPassword', '$userEmail', 'user')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Gagal mendaftar";
        }
    }
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(255, 255, 255);
        }
        .register-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-form {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .register-form h2 {
            margin-bottom: 1.5rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="col-md-4">
                <h2 class="text-center">Registrasi Akun</h2>
                <form action="registrasi.php" method="post" class="register-form p-4">
                    <div class="form-group mb-3">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                        <span class="error">* <?php echo $errorMessage; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span class="error">* <?php echo $errorMessage; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <span class="error">* <?php echo $errorMessage; ?></span>
                    </div>
                    <button type="submit" name="register" value="REGISTRASI" class="btn btn-primary btn-custom w-100 mt-3">REGISTRASI</button>
                    <p class="mt-3 text-center">Sudah punya akun? Yuk <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


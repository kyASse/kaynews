<?php
include_once("config.php");

$namaErr = $emailErr = $passErr = $roleErr = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

if (isset($_POST['register'])) {
    $nama = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $pass = md5($_POST['password']);
    $role = 'user';

    if (empty($nama)) {
        $namaErr = "Username tidak boleh kosong";
    }

    if (empty($email)) {
        $emailErr = "Email tidak boleh kosong";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email salah";
        }
    }

    if (empty($pass)) {
        $passErr = "Password tidak boleh kosong";
    } else if (strlen($_POST['password']) < 6) {
        $passErr = "Password harus memiliki minimal 6 karakter";
    } else if (!preg_match('/[A-Z]/', $_POST['password'])) {
        $passErr = "Password harus memiliki minimal satu huruf kapital";
    } else if (!preg_match('/[0-9]/', $_POST['password'])) {
        $passErr = "Password harus memiliki minimal satu angka";
    } else {
        $sql = "INSERT INTO users (name, password, email, role) VALUES ('$nama', '$pass', '$email', '$role')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "<script>alert('Anda berhasil mendaftar');window.location.href='login.php';</script>"
        } else {
            echo "Gagal mendaftar";
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
</head>
<body>
<h2>Registrasi Akun</h2>
<form action="registrasi.php" method="post">
    <div class="login"></div>
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username"><br>
        <span class="error">* <?php echo $namaErr; ?></span>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br>
        <span class="error">* <?php echo $passErr; ?></span>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email"><br>
        <span class="error">* <?php echo $emailErr; ?></span>
        <input type="submit" name="register" value="REGISTRASI">
    </div>
</form>
</body>
</html>


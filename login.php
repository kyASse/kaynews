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
</head>
<body>
    <h1>Halaman Login</h1>

    <form action="cek_login.php" method="post">
        <div class="login">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br><br>
            <span>Belum punya akun? Yuk<a href="registrasi.php">Daftar</a></span>
            <input type="submit" value="LOGIN">
        </div>
    </form>
</body>
</html>

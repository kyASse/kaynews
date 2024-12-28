<?php
include_once("config.php");
$username = $_POST['username'];
$pass = md5($_POST['password']);
$sql = "SELECT * FROM users WHERE name='$username' AND password='$pass'";
$login = mysqli_query($con, $sql);

$ketemu = mysqli_num_rows($login);
$r = mysqli_fetch_array($login);

if ($ketemu > 0) {
    session_start();
    $_SESSION["login"] = true;
    $_SESSION['iduser'] = $r['id_user'];
    $_SESSION['passuser'] = $r['password'];
    $_SESSION['role'] = $r['role'];
    header('location:index.php');
    exit;
} else {
    echo "<script>alert('Login gagal! username & password tidak benar');window.location.href='login.php';</script>";
}

?>
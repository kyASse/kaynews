<?php
// Memanggil file koneksi.php
include_once("config.php");

// Mengecek apakah ID telah disediakan di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Syntax untuk menghapus data berdasarkan id
    $result = mysqli_query($con, "DELETE FROM articles WHERE id='$id'");

    // Mengecek apakah penghapusan berhasil
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($con);
    }
} else {
    echo "ID tidak ditemukan";
    exit();
}


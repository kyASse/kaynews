<?php
include_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($con, "DELETE FROM articles WHERE id='$id'");

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


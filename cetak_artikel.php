<?php
include_once('config.php');
require_once('fpdf/fpdf.php');

// Ambil id artikel dari url
$id = $_GET['id'] ?? '';

// Ambil data artikel
$result = mysqli_query($con, "select * from articles where id = $id");
$artikel = mysqli_fetch_assoc($result);

// Cek apakah data ditemukan
if ($artikel) {
    // Buat objek fpdf
    $pdf = new FPDF();

    // Tambahkan halaman
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Tambahkan judul
    $pdf->Cell(0, 10, $artikel['title'], 0, 1, 'C');

    // Tambahkan gambar
    $pdf->Image($artikel['image_url'], $pdf->GetX(), $pdf->GetY(), 50);

    // Tambahkan isi
    $pdf->MultiCell(0, 5, $artikel['body'], 0, 'J');

    // Tambahkan penulis dan tanggal
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Oleh ' . $artikel['author'] . ' pada ' . date('d-m-Y', strtotime($artikel['published_at'])), 0, 1, 'L');

    // Output pdf
    $pdf->Output('artikel-' . $id . '.pdf', 'I');
} else {
    echo "Data tidak ditemukan";
}


<?php
include_once('config.php');
require_once('fpdf/fpdf.php');

$id = $_GET['id'] ?? '';

// Ambil data artikel
$result = mysqli_query($con, "select * from articles where id = $id");
$artikel = mysqli_fetch_assoc($result);

// Cek apakah data ditemukan
if ($artikel) {
    // Buat objek fpdf
    $pdf = new FPDF();

    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(0, 10, $artikel['title'], 0, 1, 'C');

    // Tambahkan gambar
    $imageX = $pdf->GetX();
    $imageY = $pdf->GetY();
    $pdf->SetXY($imageX + 105, $imageY);
    
    if (filter_var($artikel['image_url'], FILTER_VALIDATE_URL)) {
        $pdf->Image($artikel['image_url'], $imageX, $imageY, 185);
    } else {
        $pdf->Image('uploads/' . $artikel['image_url'], $imageX, $imageY, 50);
    }
    
    $pdf->Ln(95);
    
    //isi artikel
    $pdf->MultiCell(0, 5, $artikel['body'], 0, 'J');

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Oleh ' . $artikel['author_id'] . ' pada ' . date('d-m-Y', strtotime($artikel['published_at'])), 0, 1, 'L');

    // Output pdf
    $pdf->Output('artikel-' . $id . '.pdf', 'I');
} else {
    echo "Data tidak ditemukan";
}


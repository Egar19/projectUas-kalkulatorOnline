<?php
session_start();
require 'db.php'; // Memuat file untuk koneksi ke database
require 'auth.php'; // Memuat file untuk fungsi otentikasi pengguna
require 'vendor/autoload.php'; // Memuat autoload untuk TCPDF (asumsi TCPDF di-load secara otomatis)

if (!is_logged_in()) {
    header('Location: login.php'); // Jika pengguna tidak login, arahkan ke halaman login
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi saat ini

// Menyiapkan query untuk mengambil riwayat perhitungan pengguna berdasarkan ID pengguna
$stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$calculations = $stmt->fetchAll(); // Ambil semua hasil perhitungan dalam bentuk array

// Membuat dokumen PDF baru menggunakan TCPDF
$pdf = new TCPDF();
$pdf->AddPage(); // Menambahkan halaman baru ke dokumen PDF

// Mengatur judul dan penulis dokumen
$pdf->SetTitle('Riwayat Perhitungan');
$pdf->SetAuthor('Kalkulator Online');

// Menambahkan judul "Riwayat Perhitungan" ke dokumen PDF
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 15, 'Riwayat Perhitungan', 0, 1, 'C');

// Mengatur gaya font untuk konten dokumen PDF
$pdf->SetFont('helvetica', '', 12);

// Menambahkan riwayat perhitungan ke dokumen PDF
foreach ($calculations as $calculation) {
    $expression = $calculation['expression']; // Ekspresi perhitungan
    $result = $calculation['result']; // Hasil perhitungan
    $pdf->Cell(0, 10, "$expression = $result", 0, 1); // Menambahkan setiap entri perhitungan sebagai sel di dokumen PDF
}

// Outputkan dokumen PDF sebagai unduhan dengan nama file 'calculation_history.pdf'
$pdf->Output('calculation_history.pdf', 'D');
?>

<?php
session_start();
require 'db.php'; // Memuat file untuk koneksi ke database
require 'auth.php'; // Memuat file untuk fungsi otentikasi pengguna

if (!is_logged_in()) {
    header('Location: login.php'); // Jika pengguna tidak login, arahkan ke halaman login
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi saat ini

// Menyiapkan query untuk mengambil riwayat perhitungan pengguna berdasarkan ID pengguna, diurutkan berdasarkan tanggal dibuat (created_at) secara menurun
$stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$calculations = $stmt->fetchAll(); // Ambil semua hasil perhitungan dalam bentuk array

// Set headers untuk download file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="calculation_history.csv"');

// Membuat file pointer yang terhubung dengan output stream
$output = fopen('php://output', 'w');

// Menulis header kolom (jika diperlukan)
fputcsv($output, ['Ekspresi', 'Hasil', 'Tanggal']);

// Menulis data perhitungan ke file CSV
foreach ($calculations as $calculation) {
    $expression = $calculation['expression']; // Ekspresi perhitungan
    $result = $calculation['result']; // Hasil perhitungan
    $created_at = $calculation['created_at']; // Tanggal dibuat (asumsi terdapat kolom 'created_at' di database)
    fputcsv($output, [$expression, $result, $created_at]); // Menulis baris data perhitungan ke file CSV
}

// Menutup file pointer
fclose($output);
?>

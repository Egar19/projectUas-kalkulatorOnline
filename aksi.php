<?php
session_start(); // Memulai sesi PHP untuk mengelola data sesi

require 'db.php'; // Memuat file koneksi ke database

if (!isset($_SESSION['user_id'])) { // Memeriksa apakah pengguna telah login
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit(); // Mengakhiri eksekusi script PHP
}

function calculateExpression($expression) {
    // Fungsi untuk menghitung ekspresi matematika

    // Membersihkan dan mengganti fungsi trigonometri dan logaritma
    $expression = preg_replace_callback('/(\w+)\s*\(([^)]+)\)/', function($matches) {
        $func = strtolower($matches[1]); // Mengambil nama fungsi dalam lowercase
        $args = $matches[2]; // Mengambil argumen dari fungsi

        switch ($func) {
            case 'sin':
                return 'sin(' . $args . ')'; 
            case 'cos':
                return 'cos(' . $args . ')'; 
            case 'tan':
                return 'tan(' . $args . ')'; 
            case 'log':
                return 'log10(' . $args . ')'; 
            default:
                return $matches[0]; // Mengembalikan ekspresi asli jika tidak ada yang cocok
        }
    }, $expression);

    // Evaluasi ekspresi matematika
    try {
        $result = eval("return $expression;"); // Evaluasi ekspresi menggunakan eval
        if ($result === false || $result === null) {
            throw new Exception("Error in calculation"); // Lempar exception jika terjadi kesalahan dalam perhitungan
        }
        return $result; // Mengembalikan hasil perhitungan
    } catch (ParseError | Exception $e) {
        return 'Error in calculation'; // Mengembalikan pesan kesalahan jika terjadi kesalahan dalam perhitungan
    }
}

if (isset($_POST['submit_calculate'])) { // Memeriksa apakah tombol submit perhitungan ditekan
    $expression = $_POST['display']; // Mengambil ekspresi matematika dari input display
    $result = calculateExpression($expression); // Menghitung ekspresi matematika
    $user_id = $_SESSION['user_id']; // Mengambil ID pengguna dari sesi

    // Menyimpan perhitungan ke dalam database
    $stmt = $pdo->prepare("INSERT INTO calculations (user_id, expression, result) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $expression, $result]);

    // Redirect ke halaman utama dengan hasil perhitungan
    header("Location: index.php?hasil=" . urlencode($result));
    exit(); // Mengakhiri eksekusi script PHP
}

if (isset($_POST['hapus_semua'])) { // Memeriksa apakah tombol hapus semua ditekan
    $user_id = $_SESSION['user_id']; // Mengambil ID pengguna dari sesi
    $stmt = $pdo->prepare("DELETE FROM calculations WHERE user_id = ?"); // Menghapus semua perhitungan pengguna dari database
    $stmt->execute([$user_id]);

    header("Location: index.php"); // Redirect kembali ke halaman utama
    exit(); // Mengakhiri eksekusi script PHP
}

if (isset($_GET['hapus'])) { // Memeriksa apakah parameter hapus diberikan di URL
    $id = $_GET['hapus']; // Mengambil ID perhitungan yang akan dihapus
    $stmt = $pdo->prepare("DELETE FROM calculations WHERE id = ?"); // Menghapus perhitungan berdasarkan ID
    $stmt->execute([$id]);

    header("Location: index.php"); // Redirect kembali ke halaman utama
    exit(); // Mengakhiri eksekusi script PHP
}
?>

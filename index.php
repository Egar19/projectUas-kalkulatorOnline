<?php
session_start(); // Memulai session
require 'db.php'; // Menghubungkan ke database
require 'auth.php'; // Menyertakan fungsi otentikasi

// Memeriksa status login pengguna
if (!is_logged_in()) {
    header('Location: login.php'); // Mengarahkan ke halaman login jika belum login
    exit(); // Menghentikan eksekusi lebih lanjut
}

$user_id = $_SESSION['user_id']; // Menyimpan user_id dari session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Online</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="dist/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar shadow">
        <?php include 'views/nav.php'; // Menampilkan navbar dari file nav.php ?>
    </nav>

    <!-- Main Content -->
    <main class="row">
        <?php
        include 'views/calc.php'; // Menampilkan kalkulator dari file calc.php
        include 'views/hasil.php'; // Menampilkan hasil dari file hasil.php
        include 'views/guide.php'; // Menampilkan panduan penggunaan dari file guide.php
        ?>
    </main>

    <!-- Footer -->
    <footer>
        <?php include 'views/footer.php'; // Menampilkan footer dari file footer.php ?>
    </footer>

    <!-- JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script> <!-- JavaScript Bootstrap -->
    <script src="script.js"></script> <!-- JavaScript custom -->
</body>
</html>

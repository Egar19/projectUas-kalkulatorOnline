<?php
$host = 'localhost'; // Nama host database, dalam kasus ini 'localhost'
$db = 'kalkulator_online'; // Nama database yang digunakan
$user = 'root'; // Nama pengguna database, dalam kasus ini 'root'
$pass = ''; // Kata sandi untuk pengguna database, dalam kasus ini kosong (default untuk XAMPP)
$charset = 'utf8mb4'; // Karakter set untuk koneksi database

// Data Source Name (DSN) untuk PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mode error handling: lempar exception untuk error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode pengambilan data default: array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false, // Menonaktifkan emulasi prepared statements
];

try {
    // Membuat objek PDO untuk koneksi ke database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Tangkap dan lempar kembali PDOException jika terjadi kesalahan koneksi
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

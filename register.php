<?php
session_start(); // Memulai session
require 'db.php'; // Menghubungkan ke database
require 'auth.php'; // Menyertakan fungsi otentikasi

$error = ''; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Mengambil nilai dari form untuk username
    $password = $_POST['password']; // Mengambil nilai dari form untuk password

    // Memanggil fungsi register untuk mencoba mendaftarkan pengguna
    if (register($username, $password)) {
        header('Location: login.php'); // Mengarahkan ke halaman login jika registrasi berhasil
        exit(); // Menghentikan eksekusi lebih lanjut
    } else {
        $error = 'Registration failed, please try again'; // Menetapkan pesan kesalahan jika registrasi gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css"> <!-- Memuat file CSS Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Akun</h1>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
            <?php if ($error): ?>
                <p class="text-danger"><?php echo $error; ?></p> <!-- Menampilkan pesan kesalahan jika ada -->
            <?php endif; ?>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login disini</a>.</p> <!-- Tautan untuk login jika sudah punya akun -->
    </div>
</body>
</html>

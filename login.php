<?php
session_start(); // Memulai session
require 'db.php'; // Menghubungkan ke database
require 'auth.php'; // Menyertakan fungsi otentikasi

if (is_logged_in()) {
    header('Location: index.php'); // Mengarahkan ke halaman utama jika pengguna sudah login
    exit(); // Menghentikan eksekusi lebih lanjut
}

$error = ''; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Mengambil nilai dari form untuk username
    $password = $_POST['password']; // Mengambil nilai dari form untuk password

    // Memanggil fungsi login untuk memeriksa login pengguna
    if (login($username, $password)) {
        header('Location: index.php'); // Mengarahkan ke halaman utama jika login berhasil
        exit(); // Menghentikan eksekusi lebih lanjut
    } else {
        $error = 'Invalid username or password'; // Menetapkan pesan kesalahan jika login gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css"> <!-- Memuat file CSS Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <?php if ($error): ?>
                <p class="text-danger"><?php echo $error; ?></p> <!-- Menampilkan pesan kesalahan jika ada -->
            <?php endif; ?>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar disini</a>.</p> <!-- Tautan untuk mendaftar jika belum punya akun -->
    </div>
</body>
</html>

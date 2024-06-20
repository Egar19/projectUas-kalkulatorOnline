<?php
// Fungsi untuk mendaftarkan pengguna baru ke dalam database
function register($username, $password) {
    global $pdo;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);     //Hash pw sebelum ke database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");     // Persiapkan dan jalankan query SQL untuk memasukkan username dan password hashed ke dalam tabel 'users'
    return $stmt->execute([$username, $hashed_password]);     // Eksekusi query dengan mengirimkan parameter username dan password hashed
}

// Fungsi untuk memeriksa login pengguna berdasarkan username dan password
function login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?"); // Persiapkan dan jalankan query SQL untuk mengambil id pengguna dan password dari tabel 'users' berdasarkan username
    $stmt->execute([$username]);     // Eksekusi query dengan mengirimkan parameter username
    $user = $stmt->fetch();       // Ambil baris hasil query sebagai array asosiatif

    // Periksa apakah pengguna ditemukan dan password yang dimasukkan cocok dengan password yang di-hash
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

// Fungsi untuk memeriksa apakah pengguna sudah login atau belum
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>

<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghapus sesi
header("Location: login.php"); // Redirect ke halaman login
exit();
?>

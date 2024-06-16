<?php
session_start();
require 'db.php';
require 'auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (register($username, $password)) {
        header('Location: login.php');
        exit();
    } else {
        $error = 'Registration failed, please try again';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
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
                <p class="text-danger"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login disini</a>.</p>
    </div>
</body>
</html>

<?php
session_start();
require 'db.php';
require 'auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
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
    <nav class="navbar shadow">
        <?php
        include 'views/nav.php';
        ?>
    </nav>
    <main class="row">
        <?php
        include 'views/calc.php';
        include 'views/hasil.php';
        ?>
    </main>
    <footer>
        <?php 
        include 'views/footer.php';
        ?>
    </footer>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
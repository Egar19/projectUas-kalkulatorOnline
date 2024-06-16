<?php
session_start();
require 'db.php';
require 'auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$calculations = $stmt->fetchAll();

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="calculation_history.csv"');

// Create a file pointer connected to output stream
$output = fopen('php://output', 'w');

// Write headers (if needed)
fputcsv($output, ['Expression', 'Result', 'Date']);

// Write calculation data
foreach ($calculations as $calculation) {
    $expression = $calculation['expression'];
    $result = $calculation['result'];
    $created_at = $calculation['created_at']; // Assuming your DB has a 'created_at' field
    fputcsv($output, [$expression, $result, $created_at]);
}

// Close the file pointer
fclose($output);
?>

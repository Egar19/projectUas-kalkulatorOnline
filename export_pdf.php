<?php
session_start();
require 'db.php';
require 'auth.php';
require 'vendor/autoload.php'; 

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$calculations = $stmt->fetchAll();

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Set title and author
$pdf->SetTitle('Calculation History');
$pdf->SetAuthor('Kalkulator Online');

// Add a title
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 15, 'Calculation History', 0, 1, 'C');

// Set font for the content
$pdf->SetFont('helvetica', '', 12);

// Add the calculation history
foreach ($calculations as $calculation) {
    $expression = $calculation['expression'];
    $result = $calculation['result'];
    $pdf->Cell(0, 10, "$expression = $result", 0, 1);
}

// Output the PDF as a download
$pdf->Output('calculation_history.pdf', 'D');
?>

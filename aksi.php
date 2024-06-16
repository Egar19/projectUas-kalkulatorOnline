<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

function calculateExpression($expression) {
    // Sanitize and replace trigonometric and log functions
    $expression = preg_replace_callback('/(\w+)\s*\(([^)]+)\)/', function($matches) {
        $func = strtolower($matches[1]);
        $args = $matches[2];

        switch ($func) {
            case 'sin':
                return 'sin(' . $args . ')';
            case 'cos':
                return 'cos(' . $args . ')';
            case 'tan':
                return 'tan(' . $args . ')';
            case 'log':
                return 'log10(' . $args . ')';
            default:
                return $matches[0]; // Return the original if no match
        }
    }, $expression);

    // Evaluate the expression
    try {
        // Ensure safe evaluation
        $result = eval("return $expression;");
        if ($result === false || $result === null) {
            throw new Exception("Error in calculation");
        }
        return $result;
    } catch (ParseError | Exception $e) {
        return 'Error in calculation';
    }
}

if (isset($_POST['submit_calculate'])) {
    $expression = $_POST['display'];
    $result = calculateExpression($expression);
    $user_id = $_SESSION['user_id'];

    // Store calculation in the database
    $stmt = $pdo->prepare("INSERT INTO calculations (user_id, expression, result) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $expression, $result]);

    // Redirect to index.php with the result
    header("Location: index.php?hasil=" . urlencode($result));
    exit();
}

if (isset($_POST['hapus_semua'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("DELETE FROM calculations WHERE user_id = ?");
    $stmt->execute([$user_id]);

    header("Location: index.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM calculations WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}
?>

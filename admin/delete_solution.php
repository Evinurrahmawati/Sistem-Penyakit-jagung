<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_solusi = $_GET['id'] ?? 0;
if ($id_solusi) {
    $stmt = $pdo->prepare("DELETE FROM solusi WHERE id_solusi = ?");
    $stmt->execute([$id_solusi]);
}

header("Location: solutions.php");
<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_penyakit = $_GET['id'] ?? '';
if ($id_penyakit) {
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM aturan WHERE id_penyakit = ?");
    $stmt->execute([$id_penyakit]);
    $rulesCount = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM solusi WHERE id_penyakit = ?");
    $stmt->execute([$id_penyakit]);
    $solutionsCount = $stmt->fetchColumn();
    
    if ($rulesCount > 0 || $solutionsCount > 0) {
        $_SESSION['error'] = "Penyakit tidak dapat dihapus karena masih digunakan dalam basis pengetahuan atau solusi!";
    } else {
        $stmt = $pdo->prepare("DELETE FROM penyakit WHERE id_penyakit = ?");
        $stmt->execute([$id_penyakit]);
    }
}

header("Location: diseases.php");
?>
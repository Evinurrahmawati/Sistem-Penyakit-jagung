<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_gejala = $_GET['id'] ?? '';
if ($id_gejala) {

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM aturan WHERE id_gejala = ?");
    $stmt->execute([$id_gejala]);
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        $_SESSION['error'] = "Gejala tidak dapat dihapus karena masih digunakan dalam basis pengetahuan!";
    } else {
        $stmt = $pdo->prepare("DELETE FROM gejala WHERE id_gejala = ?");
        $stmt->execute([$id_gejala]);
    }
}

header("Location: symptoms.php");
?>

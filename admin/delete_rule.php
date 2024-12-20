<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_aturan = $_GET['id'] ?? 0;

if ($id_aturan) {
    try {
        $stmt = $pdo->prepare("DELETE FROM aturan WHERE id_aturan = ?");
        $stmt->execute([$id_aturan]);
        
        $_SESSION['success'] = "Aturan berhasil dihapus!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menghapus aturan: " . $e->getMessage();
    }
}

header("Location: rules.php");
exit();
?>

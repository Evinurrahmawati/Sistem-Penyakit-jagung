<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penyakit = $_POST['id_penyakit'];
    $id_gejala = $_POST['id_gejala'];
    $cf_pakar = $_POST['cf_pakar'];
    
    try {
        if (isset($_POST['action']) && $_POST['action'] == 'edit') {
            $id_aturan = $_POST['id_aturan'];
            $stmt = $pdo->prepare("
                UPDATE aturan 
                SET id_penyakit = ?, id_gejala = ?, cf_pakar = ? 
                WHERE id_aturan = ?
            ");
            $stmt->execute([$id_penyakit, $id_gejala, $cf_pakar, $id_aturan]);
            $_SESSION['success'] = "Aturan berhasil diperbarui!";
        } else {
            $stmt - $pdo->prepare("
                INSERT INTO aturan (id_penyakit, id_gejala, cf_pakar) 
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$id_penyakit, $id_gejala, $cf_pakar]);
            $_SESSION['success'] = "Aturan baru berhasil ditambahkan!";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menyimpan aturan: " . $e->getMessage();
    }
    
    header("Location: rules.php");
    exit();
}
?>
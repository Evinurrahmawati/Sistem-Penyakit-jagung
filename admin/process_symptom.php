<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_gejala = $_POST['id_gejala'];
    $nama_gejala = $_POST['nama_gejala'];
    
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $stmt = $pdo->prepare("UPDATE gejala SET nama_gejala = ? WHERE id_gejala = ?");
        $stmt->execute([$nama_gejala, $id_gejala]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO gejala (id_gejala, nama_gejala) VALUES (?, ?)");
        $stmt->execute([$id_gejala, $nama_gejala]);
    }
    
    header("Location: symptoms.php");
}
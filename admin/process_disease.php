<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penyakit = $_POST['id_penyakit'];
    $nama_penyakit = $_POST['nama_penyakit'];

    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $stmt = $pdo->prepare("UPDATE penyakit SET nama_penyakit = ? WHERE id_penyakit = ?");
        $stmt->execute([$nama_penyakit, $id_penyakit]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO penyakit (id_penyakit, nama_penyakit) VALUES (?, ?)");
        $stmt->execute([$id_penyakit, $nama_penyakit]);
    }

    header("Location: diseases.php");
}
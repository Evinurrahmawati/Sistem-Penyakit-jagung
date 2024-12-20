<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("SELECT MAX(id_gejala) as max_id FROM gejala");
$result = $stmt->fetch();
$lastId = $result['max_id'];
$nextId = 'G' . str_pad((intval(substr($lastId, 1)) + 1), 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gejala</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../assets/logo.png" />
</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">SISPAK JAGUNG</div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="diseases.php">Data Penyakit</a></li>
                <li><a href="symptoms.php">Data Gejala</a></li>
                <li><a href="rules.php">Basis Pengetahuan</a></li>
                <li><a href="solutions.php">Data Solusi</a></li>
                <li><a href="change_password.php">Ubah Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-navbar">
                <div class="navbar-title">Tambah Data Gejala</div>
            </div>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Tambah Gejala</h2>
                </div>
                
                <form action="process_symptom.php" method="POST">
                    <div class="form-group">
                        <label class="form-label">ID Gejala</label>
                        <input type="text" name="id_gejala" value="<?= $nextId ?>" required
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Gejala</label>
                        <input type="text" name="nama_gejala" required
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="symptoms.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
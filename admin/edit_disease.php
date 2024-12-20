<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_penyakit = $_GET['id'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM penyakit WHERE id_penyakit = ?");
$stmt->execute([$id_penyakit]);
$disease = $stmt->fetch();

if (!$disease) {
    header("Location: diseases.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penyakit</title>
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
                <div class="navbar-title">Edit Data Penyakit</div>
            </div>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Edit Penyakit</h2>
                </div>
                
                <form action="process_disease.php" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_penyakit" value="<?= $disease['id_penyakit'] ?>">
                    
                    <div class="form-group">
                        <label class="form-label">ID Penyakit</label>
                        <input type="text" value="<?= $disease['id_penyakit'] ?>" disabled
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Penyakit</label>
                        <input type="text" name="nama_penyakit" required
                               value="<?= $disease['nama_penyakit'] ?>"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="diseases.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
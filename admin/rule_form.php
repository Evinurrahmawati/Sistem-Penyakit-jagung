<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$diseases = $pdo->query("SELECT * FROM penyakit ORDER BY id_penyakit")->fetchAll();
$symptoms = $pdo->query("SELECT * FROM gejala ORDER BY id_gejala")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Basis Pengetahuan</title>
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
                <div class="navbar-title">Tambah Basis Pengetahuan</div>
            </div>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Tambah Aturan Baru</h2>
                </div>
                
                <form action="process_rule.php" method="POST">
                    <div class="form-group">
                        <label class="form-label">Penyakit</label>
                        <select name="id_penyakit" required class="form-input">
                            <?php foreach ($diseases as $disease): ?>
                            <option value="<?= $disease['id_penyakit'] ?>">
                                <?= $disease['nama_penyakit'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Gejala</label>
                        <select name="id_gejala" required class="form-input">
                            <?php foreach ($symptoms as $symptom): ?>
                            <option value="<?= $symptom['id_gejala'] ?>">
                                <?= $symptom['nama_gejala'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">CF Pakar</label>
                        <select name="cf_pakar" required class="form-input">
                            <option value="0.2">0.2 - Tidak Yakin</option>
                            <option value="0.4">0.4 - Kurang Yakin</option>
                            <option value="0.6">0.6 - Cukup Yakin</option>
                            <option value="0.8">0.8 - Yakin</option>
                            <option value="1.0">1.0 - Sangat Yakin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="rules.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
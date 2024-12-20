<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php"); 
    exit();
}

$id_solusi = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM solusi WHERE id_solusi = ?");
$stmt->execute([$id_solusi]);
$solution = $stmt->fetch();

if (!$solution) {
    header("Location: solutions.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM penyakit ORDER BY id_penyakit");
$diseases = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Solusi</title>
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
                <div class="navbar-title">Edit Data Solusi</div>
            </div>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Edit Solusi</h2>
                </div>
                
                <form action="process_solution.php" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_solusi" value="<?= $solution['id_solusi'] ?>">

                    <div class="form-group">
                        <label class="form-label">Penyakit</label>
                        <select name="id_penyakit" required class="form-input">
                            <?php foreach ($diseases as $disease): ?>
                            <option value="<?= $disease['id_penyakit'] ?>" 
                                    <?= ($disease['id_penyakit'] == $solution['id_penyakit']) ? 'selected' : '' ?>>
                                <?= $disease['nama_penyakit'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Solusi</label>
                        <textarea name="solusi" required rows="4" 
                                  class="form-input"><?= $solution['solusi'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="solutions.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
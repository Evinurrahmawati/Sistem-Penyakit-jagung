<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_aturan = $_GET['id'] ?? 0;
if (!$id_aturan) {
    header("Location: rules.php");
    exit();
}

$stmt = $pdo->prepare("
    SELECT a.*, p.nama_penyakit, g.nama_gejala 
    FROM aturan a
    JOIN penyakit p ON a.id_penyakit = p.id_penyakit
    JOIN gejala g ON a.id_gejala = g.id_gejala
    WHERE a.id_aturan = ?
");
$stmt->execute([$id_aturan]);
$rule = $stmt->fetch();

if (!$rule) {
    header("Location: rules.php");
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
    <title>Edit Aturan</title>
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
                <div class="navbar-title">Edit Basis Pengetahuan</div>
            </div>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Edit Aturan</h2>
                </div>
                
                <form action="process_rule.php" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_aturan" value="<?= $rule['id_aturan'] ?>">

                    <div class="form-group">
                        <label class="form-label">Penyakit</label>
                        <select name="id_penyakit" required class="form-input">
                            <?php foreach ($diseases as $disease): ?>
                            <option value="<?= $disease['id_penyakit'] ?>" 
                                    <?= ($disease['id_penyakit'] == $rule['id_penyakit']) ? 'selected' : '' ?>>
                                <?= $disease['nama_penyakit'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Gejala</label>
                        <select name="id_gejala" required class="form-input">
                            <?php foreach ($symptoms as $symptom): ?>
                            <option value="<?= $symptom['id_gejala'] ?>"
                                    <?= ($symptom['id_gejala'] == $rule['id_gejala']) ? 'selected' : '' ?>>
                                <?= $symptom['nama_gejala'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">CF Pakar</label>
                        <select name="cf_pakar" required class="form-input">
                            <option value="0.2" <?= ($rule['cf_pakar'] == 0.2) ? 'selected' : '' ?>>0.2 - Tidak Yakin</option>
                            <option value="0.4" <?= ($rule['cf_pakar'] == 0.4) ? 'selected' : '' ?>>0.4 - Kurang Yakin</option>
                            <option value="0.6" <?= ($rule['cf_pakar'] == 0.6) ? 'selected' : '' ?>>0.6 - Cukup Yakin</option>
                            <option value="0.8" <?= ($rule['cf_pakar'] == 0.8) ? 'selected' : '' ?>>0.8 - Yakin</option>
                            <option value="1.0" <?= ($rule['cf_pakar'] == 1.0) ? 'selected' : '' ?>>1.0 - Sangat Yakin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="rules.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
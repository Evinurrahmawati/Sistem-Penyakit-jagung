<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("
    SELECT a.*, p.nama_penyakit, g.nama_gejala 
    FROM aturan a
    JOIN penyakit p ON a.id_penyakit = p.id_penyakit
    JOIN gejala g ON a.id_gejala = g.id_gejala
    ORDER BY a.id_penyakit, a.id_gejala
");
$rules = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Basis Pengetahuan</title>
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
                <div class="navbar-title">Kelola Basis Pengetahuan</div>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="content-box">
                <div class="box-header">
                    <h2 class="box-title">Data Basis Pengetahuan</h2>
                    <a href="rule_form.php" class="btn btn-primary">Tambah Aturan</a>
                </div>
                
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penyakit</th>
                            <th>Gejala</th>
                            <th>CF Pakar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rules as $rule): ?>
                        <tr>
                            <td><?= $rule['id_aturan'] ?></td>
                            <td><?= $rule['nama_penyakit'] ?></td>
                            <td><?= $rule['nama_gejala'] ?></td>
                            <td><?= $rule['cf_pakar'] ?></td>
                            <td>
                                <a href="edit_rule.php?id=<?= $rule['id_aturan'] ?>" 
                                   class="btn btn-primary">Edit</a>
                                <a href="delete_rule.php?id=<?= $rule['id_aturan'] ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

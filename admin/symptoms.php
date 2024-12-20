<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM gejala ORDER BY id_gejala");
$symptoms = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gejala</title>
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
                <div class="navbar-title">Kelola Data Gejala</div>
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
                    <h2 class="box-title">Data Gejala</h2>
                    <a href="symptom_form.php" class="btn btn-primary">Tambah Gejala</a>
                </div>
                
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Gejala</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($symptoms as $symptom): ?>
                        <tr>
                            <td><?= $symptom['id_gejala'] ?></td>
                            <td><?= $symptom['nama_gejala'] ?></td>
                            <td>
                                <a href="edit_symptom.php?id=<?= $symptom['id_gejala'] ?>" 
                                   class="btn btn-primary">Edit</a>
                                <a href="delete_symptom.php?id=<?= $symptom['id_gejala'] ?>" 
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
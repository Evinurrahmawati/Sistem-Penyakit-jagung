<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("
    SELECT s.*, p.nama_penyakit 
    FROM solusi s
    JOIN penyakit p ON s.id_penyakit = p.id_penyakit 
    ORDER BY s.id_penyakit
");
$solutions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Solusi</title>
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
                <div class="navbar-title">Kelola Data Solusi</div>
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
                    <h2 class="box-title">Data Solusi</h2>
                    <a href="solution_form.php" class="btn btn-primary">Tambah Solusi</a>
                </div>
                
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penyakit</th>
                            <th>Solusi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solutions as $solution): ?>
                        <tr>
                            <td><?= $solution['id_solusi'] ?></td>
                            <td><?= $solution['nama_penyakit'] ?></td>
                            <td><?= $solution['solusi'] ?></td>
                            <td>
                                <a href="edit_solution.php?id=<?= $solution['id_solusi'] ?>" 
                                   class="btn btn-primary">Edit</a>
                                <a href="delete_solution.php?id=<?= $solution['id_solusi'] ?>" 
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
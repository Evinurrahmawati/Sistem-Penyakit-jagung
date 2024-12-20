<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="navbar-title">Dashboard Admin</div>
            </div>

            <!-- Grid Menu -->
            <div class="grid">
                <div class="grid-item">
                    <h3 class="box-title">Data Penyakit</h3>
                    <p>Kelola data penyakit tanaman jagung</p>
                    <a href="diseases.php" class="btn btn-primary">Kelola →</a>
                </div>
                <div class="grid-item">
                    <h3 class="box-title">Data Gejala</h3>
                    <p>Kelola data gejala penyakit</p>
                    <a href="symptoms.php" class="btn btn-primary">Kelola →</a>
                </div>
                <div class="grid-item">
                    <h3 class="box-title">Basis Pengetahuan</h3>
                    <p>Kelola aturan diagnosa</p>
                    <a href="rules.php" class="btn btn-primary">Kelola →</a>
                </div>
                <div class="grid-item">
                    <h3 class="box-title">Data Solusi</h3>
                    <p>Kelola solusi penyakit</p>
                    <a href="solutions.php" class="btn btn-primary">Kelola →</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
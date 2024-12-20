<?php
session_start();
require_once('../config/database.php');
require_once('../includes/functions.php');

if (!isset($_SESSION['consultation_result'])) {
    header("Location: index.php");
    exit();
}

$result = $_SESSION['consultation_result'];
$disease = getPenyakitInfo($pdo, $result['id_penyakit']);
$solutions = explode('||', $disease['solusi_list']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konsultasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../assets/logo.png" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #FBF6E9;
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #118B50;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Result Styles */
        .main-content {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 20px;
        }

        .result-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .result-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #118B50, #5DB996);
        }

        .result-title {
            color: #118B50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .diagnosis-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .disease-name {
            color: #118B50;
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
        }

        .certainty-level {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .solutions-section {
            margin-top: 30px;
        }

        .solutions-title {
            color: #118B50;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .solutions-list {
            list-style: none;
        }

        .solution-item {
            padding: 10px 0;
            padding-left: 20px;
            position: relative;
            line-height: 1.6;
        }

        .solution-item::before {
            content: '•';
            color: #118B50;
            position: absolute;
            left: 0;
            font-size: 20px;
        }

        .action-button {
            display: inline-block;
            background: #118B50;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            margin-top: 30px;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background: #5DB996;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #118B50;
            color: white;
            padding: 40px 0;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #E3F0AF;
        }

        .footer-section p {
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #E3F0AF;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .result-card {
                padding: 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="../index.php" class="logo">
                <img src="../assets/logo.png" alt="Logo" width="40">
                SISPAK JAGUNG
            </a>
            <div class="nav-links">
                <a href="../index.php">Home</a>
                <a href="../index.php#features">Fitur</a>
                <a href="index.php">Konsultasi</a>
                <a href="../login.php">Admin</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="result-card">
            <h1 class="result-title">Hasil Diagnosa</h1>
            
            <div class="diagnosis-section">
                <p>Berdasarkan gejala yang dipilih, tanaman jagung Anda kemungkinan mengalami:</p>
                <div class="disease-name"><?= $disease['nama_penyakit'] ?></div>
                <div class="certainty-level">
                    dengan tingkat keyakinan: <?= number_format($result['cf_hasil'] * 100, 2) ?>%
                </div>
            </div>
            
            <div class="solutions-section">
                <h3 class="solutions-title">Solusi yang disarankan:</h3>
                <ul class="solutions-list">
                    <?php foreach ($solutions as $solution): ?>
                        <?php if (trim($solution) !== ''): ?>
                            <li class="solution-item"><?= trim($solution) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <a href="index.php" class="action-button">
                <i class="fas fa-redo"></i> Konsultasi Baru
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>
                    Sistem Pakar Diagnosa Penyakit Jagung menggunakan metode Forward Chaining
                    dan Certainty Factor untuk membantu petani mengidentifikasi penyakit pada tanaman jagung.
                </p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>
                    Email: info@sispakjagung.com<br>
                    Telepon: (021) 1234-5678<br>
                    Alamat: Jl. Pertanian No. 123
                </p>
            </div>
            <div class="footer-section">
                <h3>Sosial Media</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
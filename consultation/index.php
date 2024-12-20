<?php
session_start();
require_once('../config/database.php');
require_once('../includes/functions.php');

$stmt = $pdo->query("SELECT * FROM gejala ORDER BY id_gejala");
$gejala = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Penyakit Jagung</title>
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

        .main-content {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 20px;
        }

        .consultation-box {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .title {
            color: #118B50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .description {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
        }

        .gejala-item {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #E3F0AF;
        }

        .gejala-question {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .option-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .option-btn {
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            background: white;
            color: #118B50;
            cursor: pointer;
            font-size: 14px;
            border: 2px solid #E3F0AF;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .option-btn:hover {
            background: rgba(17, 139, 80, 0.1);
        }

        .option-btn.selected {
            background: #118B50;
            color: white;
            border-color: #118B50;
            transform: scale(1.05);
        }

        .submit-btn {
            background: #118B50;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 40px auto 0;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #5DB996;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #FFE5E5;
            color: #D63031;
            border: 1px solid #FFB5B5;
        }

        .hidden-select {
            display: none;
        }

        .footer {
            background: #118B50;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
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
            .option-group {
                flex-direction: column;
            }
            
            .option-btn {
                width: 100%;
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
               PAKAR JAGUNG
            </a>
            <div class="nav-links">
                <a href="../index.php#home">Home</a>
                <a href="../index.php#features">Fitur</a>
                <a href="index.php">Konsultasi</a>
                <a href="../login.php">Admin</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="consultation-box">
            <h1 class="title">Konsultasi Penyakit Jagung</h1>
            <p class="description">
                Pilih tingkat keyakinan untuk setiap gejala yang Anda temukan pada tanaman jagung
            </p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="process_consultation.php" method="POST" id="consultationForm">
                <?php foreach ($gejala as $g): ?>
                <div class="gejala-item">
                    <div class="gejala-question"><?= $g['nama_gejala'] ?></div>
                    <select name="gejala[<?= $g['id_gejala'] ?>]" class="hidden-select">
                        <option value="0">Tidak Ada</option>
                        <option value="0.2">Tidak Yakin</option>
                        <option value="0.4">Kurang Yakin</option>
                        <option value="0.6">Cukup Yakin</option>
                        <option value="0.8">Yakin</option>
                        <option value="1.0">Sangat Yakin</option>
                    </select>
                    <div class="option-group">
                        <button type="button" class="option-btn" data-value="0">Tidak Ada</button>
                        <button type="button" class="option-btn" data-value="0.2">Tidak Yakin</button>
                        <button type="button" class="option-btn" data-value="0.4">Kurang Yakin</button>
                        <button type="button" class="option-btn" data-value="0.6">Cukup Yakin</button>
                        <button type="button" class="option-btn" data-value="0.8">Yakin</button>
                        <button type="button" class="option-btn" data-value="1.0">Sangat Yakin</button>
                    </div>
                </div>
                <?php endforeach; ?>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-stethoscope"></i> Proses Diagnosa
                </button>
            </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const optionGroups = document.querySelectorAll('.option-group');
            
            optionGroups.forEach(group => {
                const buttons = group.querySelectorAll('.option-btn');
                const select = group.parentElement.querySelector('select');
                
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove selected class from all buttons in this group
                        buttons.forEach(btn => btn.classList.remove('selected'));
                        
                        // Add selected class to clicked button
                        this.classList.add('selected');
                        
                        // Update hidden select value
                        select.value = this.dataset.value;
                    });
                });
                
                // Set initial state
                if (select.value) {
                    const selectedBtn = group.querySelector([data-value="${select.value}"]);
                    if (selectedBtn) selectedBtn.classList.add('selected');
                }
            });
        });
    </script>
</body>
</html>
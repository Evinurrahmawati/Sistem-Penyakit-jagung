<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Jagung</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="assets/logo.png" />
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

        /* navbar */
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


       /* Footer */
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

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: url('https://static.republika.co.id/uploads/images/inpicture_slide/petani-memanen-jagung-di-kendal-jawa-tengah-jumat-14-10-_161014190631-327.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            filter: blur(8px);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #08691e;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #218838;
        }

        /* Main */
        .main-content {
            padding: 0;
            max-width: 100%;
            margin: 0;
            background: #FBF6E9;
        }

        /* Dashboard Section */
        .dashboard-container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 3rem;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 4rem;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .dashboard-left {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-left::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(44, 85, 48, 0.1) 0%, transparent 70%);
            z-index: 0;
            animation: pulse 3s infinite;
        }

        .dashboard-logo {
            width: 80%;
            height: auto;
            border-radius: 20px;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .dashboard-logo:hover {
            transform: scale(1.05);
        }

        .dashboard-right {
            padding: 2rem;
        }

        .dashboard-right h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-align: left;
            color:  #2c5530;
        }

        .dashboard-right p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 2rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(44, 85, 48, 0.1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #2c5530, #08691e);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            color: #2c5530;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .feature-card p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        /* Features Section */
        .features-container {
            max-width: 1200px;
            margin: 6rem auto;
            padding: 4rem 2rem;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .features-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 4rem;
            color:  #2c5530;
        }

        .features-columns {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 3rem;
            padding: 2.5rem;
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(44, 85, 48, 0.1);
        }

        .feature-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            flex-shrink: 0;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(44, 85, 48, 0.1), rgba(8, 105, 30, 0.05));
            border-radius: 20px;
            padding: 1.5rem;
        }

        .feature-icon img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .feature-item:hover .feature-icon img {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-content {
            flex: 1;
        }

        .feature-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c5530;
            margin-bottom: 1rem;
        }

        .feature-content p {
            font-size: 1.2rem;
            line-height: 1.7;
            color: #555;
        }

        /* Animations */
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.3;
            }
            100% {
                transform: scale(1);
                opacity: 0.5;
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-container {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem;
            }

            .features {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .feature-item {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
                padding: 2rem;
            }

            .feature-icon {
                width: 120px;
                height: 120px;
            }

            .features-title {
                font-size: 2.5rem;
            }

            .dashboard-right h2 {
                font-size: 2.2rem;
            }
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
        <div class="nav-container">
            <a href="../index.php" class="logo">
            <img src="assets/logo.png" alt="Logo" width="40">
                PAKAR JAGUNG
            </a>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#features">Fitur</a>
                <a href="consultation/index.php">Konsultasi</a>
                <a href="login.php">Admin</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Sistem Pakar Diagnosa Penyakit Tanaman Jagung</h1>
            <p> Sistem ini dapat membantu Anda mendiagnosa penyakit pada tanaman jagung menggunakan metode Forward Chaining
            dan Certainty Factor.</p>
            <a href="consultation/index.php" class="cta-button">Mulai Konsultasi</a>
        </div>
    </section>

     <!-- Main Content -->
     <div class="main-content">
        <!-- Dashboard Section -->
        <section class="section" id="dashboard">
            <div class="dashboard-container">
                <div class="dashboard-left">
                    <img src="assets/logo.png" alt="Logo Sistem Konsultasi" class="dashboard-logo">
                </div>
                <div class="dashboard-right">
                    <h2>Apa itu Pakar Jagung?</h2>
                    <p>Sistem Konsultasi Penyakit Jagung membantu petani mengidentifikasi penyakit pada tanaman jagung mereka dengan mudah dan akurat. </p>
                    <div class="features">
                        <div class="feature-card">
                            <h3>Rekomendasi</h3>
                            <p>Dapatkan rekomendasi penanganan penyakit jagung.</p>
                        </div>
                        <div class="feature-card">
                            <h3>Konsultasi</h3>
                            <p>Melakukan Konsultasi dan mendapatkan solusi yang efisien</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur -->
        <section class="section" id="features">
            <div class="features-container">
                <h2 class="features-title">Fitur Unggulan</h2>
                <div class="features-columns">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="assets/diagnosis.png" alt="Diagnosis Cepat">
                        </div>
                        <div class="feature-content">
                            <h3>Diagnosis Cepat</h3>
                            <p>Identifikasi penyakit jagung dengan cepat dan akurat berdasarkan gejala yang terlihat.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="assets/daftar.png" alt="Basis Pengetahuan">
                        </div>
                        <div class="feature-content">
                            <h3>Daftar Penyakit Jagung</h3>
                            <p>Akses informasi lengkap tentang berbagai penyakit jagung dan cara penanganannya.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="assets/bagikan.png" alt="Konsultasi">
                        </div>
                        <div class="feature-content">
                            <h3>Konsultasi</h3>
                            <p>Melakukan konsultasi dan mendapatkan solusi yang efisien</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
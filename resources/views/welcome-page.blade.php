<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP Management System - Kelola Pembayaran SPP Modern</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #2e7d32;
            --light-green: #e8f5e9;
            --accent-yellow: #fffde7;
            --text-dark: #2f4f4f;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #f9fbe7, #dff5ea, #c8f0e0);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 15px 0;
            border-bottom: 1px solid #e0f2f1;
            z-index: 1000;
            transition: var(--transition);
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
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-green);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-links a {
            color: #388e3c;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--primary-green);
        }

        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 20px 60px;
        }

        .hero-badge {
            background: var(--light-green);
            color: var(--primary-green);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 25px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: var(--primary-green);
            margin-bottom: 20px;
            line-height: 1.2;
            max-width: 800px;
        }

        .hero p {
            font-size: 1.1rem;
            color: #4f6f64;
            max-width: 700px;
            margin-bottom: 40px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* BUTTONS */
        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #81c784, #66bb6a);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary-green);
            border: 1px solid #c8e6c9;
        }

        /* FEATURES */
        .features {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--light-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary-green);
            margin: 0 auto 25px;
        }

        /* STATS SECTION */
        .stats {
            background: white;
            padding: 80px 20px;
            margin: 50px 0;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 5px;
        }

        /* LOGIN CARDS */
        .login-section {
            padding: 100px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .login-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            text-decoration: none;
            color: inherit;
            text-align: center;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid transparent;
        }

        .login-card:hover {
            transform: scale(1.02);
            border-color: var(--primary-green);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* FAQ SECTION */
        .faq {
            max-width: 900px;
            margin: 0 auto;
            padding: 100px 20px;
        }

        .faq-item {
            background: white;
            border-radius: 16px;
            margin-bottom: 15px;
            border: 1px solid #e0f2f1;
            overflow: hidden;
        }

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }

        .faq-answer {
            padding: 0 25px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease-out;
            color: #546e7a;
        }

        .faq-item.active .faq-answer {
            padding-bottom: 20px;
            max-height: 200px;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        /* FOOTER */
        .footer {
            background: #f1f8e9;
            color: var(--text-dark);
            padding: 80px 20px 40px;
            border-top: 1px solid #dcedc8;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .footer-column h3 {
            font-size: 18px;
            margin-bottom: 25px;
            color: var(--primary-green);
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: #4f6f64;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-column ul li a:hover {
            color: var(--primary-green);
            padding-left: 5px;
        }

        .newsletter-form {
            display: flex;
            margin-top: 15px;
        }

        .newsletter-form input {
            padding: 12px;
            border: 1px solid #c8e6c9;
            border-radius: 8px 0 0 8px;
            flex: 1;
            outline: none;
        }

        .newsletter-form button {
            padding: 12px 18px;
            background: var(--primary-green);
            color: white;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            border: none;
        }

        .social-icons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .social-icons a {
            width: 38px;
            height: 38px;
            background: white;
            border: 1px solid #c8e6c9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
            text-decoration: none;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 50px auto 0;
            padding-top: 25px;
            border-top: 1px solid #dcedc8;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-wallet"></i>
                <span>SPP System</span>
            </a>
            <ul class="nav-links">
                <li><a href="#features">Fitur</a></li>
                <li><a href="#stats">Statistik</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#login">Login</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-badge">
            <i class="fas fa-wand-magic-sparkles"></i>
            Sistem Pembayaran Modern
        </div>
        <h1>Kelola Pembayaran SPP Lebih Mudah & Cepat</h1>
        <p>Platform manajemen pembayaran SPP terintegrasi untuk sekolah masa kini. Aman, transparan, dan dapat diakses kapan saja.</p>
        <div class="hero-buttons">
            <a href="#login" class="btn btn-primary">
                <i class="fas fa-rocket"></i>
                Mulai Sekarang
            </a>
            <a href="#features" class="btn btn-secondary">
                <i class="fas fa-circle-info"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <section id="features" class="features">
        <div class="section-header">
            <span class="hero-badge">Fitur Unggulan</span>
            <h2>Kenapa Memilih Kami?</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h3>Proses Cepat</h3>
                <p>Pencatatan transaksi otomatis yang hemat waktu admin sekolah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                <h3>Keamanan Data</h3>
                <p>Enkripsi data berlapis untuk menjaga privasi keuangan sekolah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                <h3>Laporan Akurat</h3>
                <p>Visualisasi data keuangan yang mudah dipahami oleh pimpinan.</p>
            </div>
        </div>
    </section>

    <section id="stats" class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Sekolah</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Siswa</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">1M+</div>
                <div class="stat-label">Transaksi</div>
            </div>
        </div>
    </section>

    <section id="login" class="login-section">
        <div class="section-header">
            <span class="hero-badge">Portal Akses</span>
            <h2>Pilih Portal Login</h2>
            <p>Silakan masuk sesuai dengan hak akses Anda</p>
        </div>
        <div class="login-grid">
            <a href="{{ route('login.form') }}" class="login-card">
                <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                <h3>Portal Petugas</h3>
                <p>Kelola data siswa dan transaksi harian.</p>
                <span class="btn btn-primary" style="margin-top:20px">Masuk Petugas</span>
            </a>

            <a href="{{ route('siswa.login.form') }}" class="login-card">
                <div class="feature-icon"><i class="fas fa-user-graduate"></i></div>
                <h3>Portal Siswa</h3>
                <p>Cek riwayat dan status pembayaran Anda.</p>
                <span class="btn btn-primary" style="margin-top:20px">Masuk Siswa</span>
            </a>
        </div>
    </section>

    <section id="faq" class="faq">
        <div class="section-header">
            <span class="hero-badge">FAQ</span>
            <h2>Pertanyaan Sering Diajukan</h2>
        </div>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara melakukan pembayaran?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">Login ke portal siswa, pilih tagihan, dan lakukan konfirmasi pembayaran kepada petugas TU.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah data saya aman?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">Kami menggunakan enkripsi standar industri untuk menjamin keamanan data transaksi sekolah.</div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <div class="logo" style="margin-bottom: 20px;">
                    <i class="fas fa-wallet"></i>
                    <span>SPP System</span>
                </div>
                <ul>
                    <li><a href="#">Enterprise Solution</a></li>
                    <li><a href="#">Mobile App</a></li>
                </ul>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#login">Login</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Stay Connected</h3>
                <div class="newsletter-form">
                    <input type="email" placeholder="Email Anda">
                    <button>Ikuti</button>
                </div>
                <p style="margin-top:20px; font-size: 14px;">Jakarta Pusat, Office 9B Tower</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 SPP Management System. Dibuat untuk Pendidikan Indonesia.</p>
        </div>
    </footer>

    <script>
        // Script untuk FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
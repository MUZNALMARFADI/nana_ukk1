<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP Management System - Fresh Green Edition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #2e7d32;
            --fresh-lime: #81c784;
            --light-green: #f1f8e9;
            --text-dark: #2f4f4f;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* ========== ALERT NOTIFICATION STYLES ========== */
        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #d5f4e6;
            color: #1e8449;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(46, 125, 50, 0.25);
            z-index: 9999;
            border: 2px solid #abebc6;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 400px;
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 14px;
        }

        .alert-notification.error {
            background: #fadbd8;
            color: #922b21;
            border-color: #f5b7b1;
        }

        .alert-notification i {
            font-size: 20px;
            flex-shrink: 0;
        }

        .alert-notification .alert-close {
            margin-left: auto;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            background: none;
            border: none;
            color: inherit;
            font-size: 18px;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-notification .alert-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .alert-notification.hiding {
            animation: slideOutRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Responsive Alert */
        @media (max-width: 768px) {
            .alert-notification {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0; width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(46, 125, 50, 0.1);
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
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-green);
            text-decoration: none;
            display: flex;
            align-items: center; gap: 10px;
        }

        .nav-links { display: flex; list-style: none; gap: 25px; }
        .nav-links a { 
            color: #388e3c; 
            text-decoration: none; 
            font-weight: 600;
            transition: var(--transition);
        }
        .nav-links a:hover { color: var(--primary-green); }

        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 20px 60px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(46, 125, 50, 0.75), rgba(27, 94, 32, 0.85)), 
                              url("{{ asset('img/hero.png') }}");
            background-size: cover;
            background-position: center;
            filter: blur(2px);
            transform: scale(1.02);
            z-index: -1;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: inline-flex; align-items: center; gap: 8px;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: white;
            margin-bottom: 20px;
            line-height: 1.2;
            max-width: 850px;
        }

        .hero p {
            font-size: 1.2rem;
            color: #e8f5e9;
            max-width: 700px;
            margin-bottom: 40px;
        }

        /* BUTTONS */
        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex; align-items: center; gap: 10px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #81c784, #66bb6a);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary-green);
        }

        /* FITUR UTAMA SECTION */
        .section-padding { padding: 100px 20px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { color: var(--primary-green); font-size: 2.2rem; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .feature-card {
            background: var(--light-green);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            background: white;
            border-color: var(--fresh-lime);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.1);
        }

        .feature-icon-circle {
            width: 70px; height: 70px;
            background: white;
            color: var(--primary-green);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; margin: 0 auto 20px;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon-circle {
            background: var(--primary-green);
            color: white;
        }

        /* PORTAL LOGIN */
        .login-section { background: #fcfdfc; padding: 100px 20px; }
        .login-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 30px; max-width: 900px; margin: 0 auto;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
            border: 1px solid #e0f2f1;
            text-align: center;
        }

        .login-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            border-color: var(--fresh-lime);
        }

        /* FAQ ACCORDION */
        .faq-section { background: white; padding: 100px 20px; }
        .faq-container { max-width: 800px; margin: 0 auto; }
        
        .faq-item {
            margin-bottom: 15px;
            border: 1px solid #e8f5e9;
            border-radius: 12px;
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            background: #f9fdf9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            color: var(--primary-green);
            transition: 0.3s;
        }

        .faq-question:hover { background: var(--light-green); }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            background: white;
            transition: all 0.4s cubic-bezier(0, 1, 0, 1);
            padding: 0 20px;
            color: #666;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 20px;
            border-top: 1px solid #e8f5e9;
        }

        .faq-item.active .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* FOOTER */
        .footer {
            background: #ffffff;
            padding: 80px 20px 30px;
            border-top: 1px solid #e8f5e9;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-column h3 { color: var(--primary-green); margin-bottom: 20px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links li a { text-decoration: none; color: #666; transition: 0.3s; }
        .footer-links li a:hover { color: var(--primary-green); padding-left: 5px; }

        .social-media { display: flex; gap: 15px; margin-top: 20px; }
        .social-icon {
            width: 40px; height: 40px;
            background: var(--light-green);
            color: var(--primary-green);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: 0.3s;
        }
        .social-icon:hover { background: var(--primary-green); color: white; }
    </style>
</head>
<body>

    <!-- ========== ALERT NOTIFICATION ========== -->
    @if(session('success'))
    <div class="alert-notification" id="alertNotification">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button class="alert-close" onclick="closeAlert()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-notification error" id="alertNotification">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button class="alert-close" onclick="closeAlert()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-wallet"></i>
                <span>SPP-PAY</span>
            </a>
            <ul class="nav-links">
                <li><a href="#features">Fitur</a></li>
                <li><a href="#login">Login</a></li>
                <li><a href="#faq">FAQ</a></li>
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
                <i class="fas fa-rocket"></i> Mulai Sekarang
            </a>
            <a href="#features" class="btn btn-secondary">
                <i class="fas fa-circle-info"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <section id="features" class="section-padding container">
        <div class="section-header">
            <div class="hero-badge" style="background: var(--light-green); color: var(--primary-green); border: none;">Layanan Kami</div>
            <h2>Fitur Unggulan Kami</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-circle"><i class="fas fa-bolt"></i></div>
                <h3>Pembayaran Kilat</h3>
                <p>Proses transaksi SPP hanya butuh hitungan detik langsung masuk database.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-circle"><i class="fas fa-shield-alt"></i></div>
                <h3>Keamanan Berlapis</h3>
                <p>Data keuangan sekolah dienkripsi dengan standar keamanan tinggi.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-circle"><i class="fas fa-chart-line"></i></div>
                <h3>Laporan Otomatis</h3>
                <p>Admin tidak perlu rekap manual, semua laporan tersaji otomatis.</p>
            </div>
        </div>
    </section>

    <section id="login" class="login-section">
        <div class="section-header">
            <h2>Pilih Portal Login</h2>
            <p>Akses akun sesuai dengan peran Anda</p>
        </div>
        <div class="login-grid">
            <a href="{{ route('login.form') }}" class="login-card">
                <div class="feature-icon-circle" style="background: var(--light-green); margin-bottom: 25px;"><i class="fas fa-user-tie"></i></div>
                <h3>Portal Petugas</h3>
                <p>Kelola data siswa, petugas, dan transaksi harian.</p>
                <div class="btn btn-primary" style="margin-top:20px; width: 100%; justify-content: center;">Masuk Admin</div>
            </a>

            <a href="{{ route('siswa.login.form') }}" class="login-card">
                <div class="feature-icon-circle" style="background: var(--light-green); margin-bottom: 25px;"><i class="fas fa-user-graduate"></i></div>
                <h3>Portal Siswa</h3>
                <p>Cek riwayat pembayaran dan tagihan Anda.</p>
                <div class="btn btn-primary" style="margin-top:20px; width: 100%; justify-content: center;">Masuk Siswa</div>
            </a>
        </div>
    </section>

    <section id="faq" class="faq-section">
        <div class="faq-container">
            <div class="section-header">
                <h2>Pertanyaan Umum</h2>
                <p>Cari tahu hal yang sering ditanyakan di sini</p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara membayar SPP?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Siswa cukup datang ke bagian petugas atau melakukan konfirmasi pembayaran setelah melakukan transfer melalui dashboard siswa.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah saya bisa melihat riwayat pembayaran?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Ya, login ke Portal Siswa untuk melihat seluruh riwayat transaksi yang sudah tervalidasi oleh petugas.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana jika terjadi kesalahan data?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Silakan hubungi admin sekolah melalui menu kontak atau datang langsung ke ruang Tata Usaha.
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-info">
                <a href="#" class="logo">
                    <i class="fas fa-wallet"></i> <span>SPP-PAY</span>
                </a>
                <p>Manajemen SPP digital yang transparan dan memudahkan seluruh stakeholder pendidikan.</p>
                <div class="social-media">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Navigasi</h3>
                <ul class="footer-links">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#features">Fitur Utama</a></li>
                    <li><a href="#login">Login</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Kontak</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt"></i> Jakarta Pusat, Indonesia</li>
                    <li><i class="fas fa-envelope"></i> info@spp-pay.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom" style="text-align: center; margin-top: 50px; color: #999; font-size: 14px;">
            <p>&copy; 2026 <strong>SPP-PAY</strong>. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // ========== FAQ ACCORDION SCRIPT ==========
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                // Tutup yang lain (opsional)
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                // Buka/Tutup yang diklik
                item.classList.toggle('active');
            });
        });

        // ========== ALERT NOTIFICATION SCRIPT ==========
        function closeAlert() {
            const alert = document.getElementById('alertNotification');
            if (alert) {
                alert.classList.add('hiding');
                setTimeout(() => alert.remove(), 300);
            }
        }

        // Auto hide alert after 5 seconds
        window.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alertNotification');
            if (alert) {
                setTimeout(() => {
                    closeAlert();
                }, 5000);
            }
        });
    </script>
</body>
</html>
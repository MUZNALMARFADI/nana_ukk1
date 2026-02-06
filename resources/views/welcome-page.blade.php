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
            overflow-x: hidden;
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

        /* ========== NAVBAR WITH SCROLL EFFECT ========== */
        .navbar {
            position: fixed;
            top: 0; width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(46, 125, 50, 0.1);
            z-index: 1000;
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
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
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .nav-links { 
            display: flex; 
            list-style: none; 
            gap: 25px; 
        }
        
        .nav-links a { 
            color: #388e3c; 
            text-decoration: none; 
            font-weight: 600;
            transition: var(--transition);
            position: relative;
            padding: 5px 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-green);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }
        
        .nav-links a:hover { 
            color: var(--primary-green);
            transform: translateY(-2px);
        }

        /* ========== HERO SECTION WITH ENHANCED ANIMATIONS ========== */
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

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 2s ease-in-out;
            transform: scale(1.1);
        }

        .hero-slide.active {
            opacity: 1;
            animation: kenburns 20s ease-out infinite alternate;
        }

        @keyframes kenburns {
            0% { transform: scale(1.1) translateX(0); }
            100% { transform: scale(1.2) translateX(-20px); }
        }

        .hero-slide::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(46, 125, 50, 0.75), rgba(27, 94, 32, 0.85));
            animation: gradientShift 10s ease infinite alternate;
        }

        @keyframes gradientShift {
            0% { opacity: 0.9; }
            100% { opacity: 0.7; }
        }

        /* Navigation Dots */
        .hero-nav {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .hero-nav-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid white;
            cursor: pointer;
            transition: 0.3s;
        }

        .hero-nav-btn:hover,
        .hero-nav-btn.active {
            background: white;
            transform: scale(1.2);
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
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            position: relative;
            z-index: 5;
            animation: fadeInDown 1s ease;
        }

        .hero-badge i {
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: white;
            margin-bottom: 20px;
            line-height: 1.2;
            max-width: 850px;
            position: relative;
            z-index: 5;
            animation: fadeInUp 1s ease 0.2s backwards;
        }

        .hero p {
            font-size: 1.2rem;
            color: #e8f5e9;
            max-width: 700px;
            margin-bottom: 40px;
            position: relative;
            z-index: 5;
            animation: fadeInUp 1s ease 0.4s backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            position: relative;
            z-index: 5;
            animation: fadeInUp 1s ease 0.6s backwards;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* ========== ENHANCED BUTTONS ========== */
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
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn i {
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: translateX(5px);
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

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* ========== SCROLL REVEAL ANIMATION ========== */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* ========== SECTIONS ========== */
        .section-padding { padding: 100px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { 
            color: var(--primary-green); 
            font-size: 2.2rem;
        }

        /* ========== ROLE TABS WITH ANIMATION ========== */
        .role-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .role-tab {
            padding: 12px 30px;
            border-radius: 25px;
            background: white;
            border: 2px solid var(--light-green);
            color: var(--text-dark);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .role-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .role-tab:hover::before {
            left: 100%;
        }

        .role-tab:hover {
            border-color: var(--fresh-lime);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.2);
        }

        .role-tab.active {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
            animation: tabPulse 0.5s ease;
        }

        @keyframes tabPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .role-tab i {
            transition: transform 0.3s ease;
        }

        .role-tab:hover i {
            transform: rotate(360deg);
        }

        /* ========== FEATURE CARDS WITH STAGGER ANIMATION ========== */
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
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(129, 199, 132, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            background: white;
            border-color: var(--fresh-lime);
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.15);
        }

        .feature-icon-circle {
            width: 70px; 
            height: 70px;
            background: white;
            color: var(--primary-green);
            border-radius: 50%;
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-size: 28px; 
            margin: 0 auto 20px;
            transition: var(--transition);
            position: relative;
            z-index: 1;
        }

        .feature-card:hover .feature-icon-circle {
            background: var(--primary-green);
            color: white;
            transform: scale(1.1) rotate(360deg);
            box-shadow: 0 10px 30px rgba(46, 125, 50, 0.3);
        }

        .feature-card h3 {
            color: var(--primary-green);
            margin-bottom: 10px;
            font-size: 1.2rem;
            transition: var(--transition);
            position: relative;
            z-index: 1;
        }

        .feature-card:hover h3 {
            transform: scale(1.05);
        }

        .feature-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .feature-badge {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 10px;
            animation: bounce 2s infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .feature-content {
            display: none;
        }

        .feature-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ========== ABOUT SECTION CARDS ========== */
        .about-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(46, 125, 50, 0.08);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .about-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, var(--fresh-lime) 0%, transparent 70%);
            opacity: 0.1;
            transition: all 0.5s;
        }

        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.15);
        }

        .about-card:hover::after {
            width: 200px;
            height: 200px;
        }

        .about-icon {
            width: 60px;
            height: 60px;
            background: var(--light-green);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .about-card:hover .about-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* ========== LOGIN CARDS ========== */
        .login-section { background: #fcfdfc; padding: 100px 20px; }
        .login-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 30px; 
            max-width: 900px; 
            margin: 0 auto;
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
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--fresh-lime) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s;
        }

        .login-card:hover::before {
            opacity: 0.1;
        }

        .login-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: var(--fresh-lime);
        }

        /* ========== FAQ ACCORDION ========== */
        .faq-section { background: white; padding: 100px 20px; }
        .faq-container { max-width: 800px; margin: 0 auto; }
        
        .faq-item {
            margin-bottom: 15px;
            border: 1px solid #e8f5e9;
            border-radius: 12px;
            overflow: hidden;
            transition: var(--transition);
        }

        .faq-item:hover {
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.1);
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
            position: relative;
            overflow: hidden;
        }

        .faq-question::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--fresh-lime), transparent);
            transition: width 0.3s;
            opacity: 0.3;
        }

        .faq-question:hover::before {
            width: 100%;
        }

        .faq-question:hover { 
            background: var(--light-green); 
        }

        .faq-question i {
            transition: transform 0.3s ease;
        }

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

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        /* ========== FOOTER ========== */
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

        .footer-column h3 { 
            color: var(--primary-green); 
            margin-bottom: 20px; 
        }

        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links li a { 
            text-decoration: none; 
            color: #666; 
            transition: 0.3s;
            display: inline-block;
        }

        .footer-links li a:hover { 
            color: var(--primary-green); 
            transform: translateX(5px);
        }

        .social-media { display: flex; gap: 15px; margin-top: 20px; }
        .social-icon {
            width: 40px; 
            height: 40px;
            background: var(--light-green);
            color: var(--primary-green);
            border-radius: 50%;
            display: flex; 
            align-items: center; 
            justify-content: center;
            text-decoration: none; 
            transition: 0.3s;
        }

        .social-icon:hover { 
            background: var(--primary-green); 
            color: white;
            transform: translateY(-5px) rotate(360deg);
        }

        /* ========== STATISTICS COUNTERS ========== */
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-nav {
                bottom: 20px;
            }

            .role-tabs {
                flex-direction: column;
                align-items: center;
            }

            .role-tab {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .alert-notification {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }

        /* ========== LOADING ANIMATION ========== */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--light-green);
            border-top-color: var(--primary-green);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body>

    <!-- ========== PAGE LOADER ========== -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- ========== ALERT NOTIFICATION ========== -->
    <div class="alert-notification" id="alertNotification" style="display: none;">
        <i class="fas fa-check-circle"></i>
        <span id="alertMessage"></span>
        <button class="alert-close" onclick="closeAlert()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-wallet"></i>
                <span>SPP-PAY</span>
            </a>
            <ul class="nav-links">
                <li><a href="#about">Tentang</a></li>
                <li><a href="#features">Fitur</a></li>
                <li><a href="#login">Login</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <!-- Background Slideshow -->
        <div class="hero-slideshow">
            <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1920');"></div>
            <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1920');"></div>
            <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1920');"></div>
        </div>

        <!-- Navigation Dots -->
        <div class="hero-nav">
            <button class="hero-nav-btn active" onclick="changeSlide(0)"></button>
            <button class="hero-nav-btn" onclick="changeSlide(1)"></button>
            <button class="hero-nav-btn" onclick="changeSlide(2)"></button>
        </div>

        <!-- Hero Content -->
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
            <a href="#about" class="btn btn-secondary">
                <i class="fas fa-circle-info"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- ========== TENTANG KAMI SECTION ========== -->
    <section id="about" class="section-padding scroll-reveal" style="background: linear-gradient(135deg, #f1f8e9 0%, #ffffff 100%);">
        <div class="container">
            <div class="section-header">
                <div class="hero-badge" style="background: white; color: var(--primary-green); border: 2px solid var(--fresh-lime);">
                    <i class="fas fa-info-circle"></i>
                    Tentang Kami
                </div>
                <h2>Kenapa Memilih SPP-PAY?</h2>
                <p>Solusi pembayaran SPP yang dirancang khusus untuk kemudahan sekolah dan siswa</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-top: 50px;">
                <!-- Card 1 -->
                <div class="about-card scroll-reveal">
                    <div class="about-icon">
                        <i class="fas fa-shield-halved" style="font-size: 28px; color: var(--primary-green);"></i>
                    </div>
                    <h3 style="color: var(--primary-green); margin-bottom: 15px; font-size: 1.3rem;">Keamanan Terjamin</h3>
                    <p style="color: #666; line-height: 1.8;">Setiap transaksi pembayaran dilindungi dengan sistem keamanan berlapis dan enkripsi data untuk menjaga privasi informasi siswa dan sekolah.</p>
                </div>

                <!-- Card 2 -->
                <div class="about-card scroll-reveal">
                    <div class="about-icon">
                        <i class="fas fa-bolt" style="font-size: 28px; color: var(--primary-green);"></i>
                    </div>
                    <h3 style="color: var(--primary-green); margin-bottom: 15px; font-size: 1.3rem;">Proses Cepat & Efisien</h3>
                    <p style="color: #666; line-height: 1.8;">Sistem otomatis yang mempercepat proses pembayaran, pencatatan, dan pelaporan. Tidak ada lagi antrian panjang atau pencatatan manual yang memakan waktu.</p>
                </div>

                <!-- Card 3 -->
                <div class="about-card scroll-reveal">
                    <div class="about-icon">
                        <i class="fas fa-chart-line" style="font-size: 28px; color: var(--primary-green);"></i>
                    </div>
                    <h3 style="color: var(--primary-green); margin-bottom: 15px; font-size: 1.3rem;">Transparansi Penuh</h3>
                    <p style="color: #666; line-height: 1.8;">Laporan keuangan yang jelas dan dapat diakses kapan saja. Orang tua dan siswa dapat memantau riwayat pembayaran secara real-time dengan mudah.</p>
                </div>
            </div>

            <!-- Statistik Section -->
            <div class="scroll-reveal" style="background: white; border-radius: 24px; padding: 50px 40px; margin-top: 50px; box-shadow: 0 10px 40px rgba(46, 125, 50, 0.1);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; text-align: center;">
                    <div>
                        <div class="stat-number">
                            <i class="fas fa-infinity"></i>
                        </div>
                        <p style="color: #666; font-weight: 600;">Transaksi Tersimpan Aman</p>
                    </div>
                    <div>
                        <div class="stat-number">24/7</div>
                        <p style="color: #666; font-weight: 600;">Akses Kapan Saja</p>
                    </div>
                    <div>
                        <div class="stat-number">100%</div>
                        <p style="color: #666; font-weight: 600;">Digital & Paperless</p>
                    </div>
                    <div>
                        <div class="stat-number">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p style="color: #666; font-weight: 600;">Validasi Otomatis</p>
                    </div>
                </div>
            </div>

            <!-- Visi Misi -->
            <div class="scroll-reveal" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 50px;">
                <div style="background: linear-gradient(135deg, var(--primary-green), #388e3c); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(46, 125, 50, 0.2); transition: var(--transition);" onmouseover="this.style.transform='translateY(-10px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                    <i class="fas fa-bullseye" style="font-size: 40px; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Visi Kami</h3>
                    <p style="line-height: 1.8; opacity: 0.95;">Menjadi platform manajemen pembayaran SPP terdepan yang memudahkan administrasi sekolah dan meningkatkan transparansi keuangan pendidikan di Indonesia.</p>
                </div>
                <div style="background: linear-gradient(135deg, #66bb6a, #81c784); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(102, 187, 106, 0.2); transition: var(--transition);" onmouseover="this.style.transform='translateY(-10px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                    <i class="fas fa-rocket" style="font-size: 40px; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Misi Kami</h3>
                    <p style="line-height: 1.8; opacity: 0.95;">Menghadirkan solusi digital yang inovatif, user-friendly, dan terpercaya untuk mengelola pembayaran SPP dengan efisien, aman, dan transparan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="section-padding container scroll-reveal">
        <div class="section-header">
            <div class="hero-badge" style="background: var(--light-green); color: var(--primary-green); border: none;">Layanan Kami</div>
            <h2>Fitur Unggulan</h2>
            <p>Setiap pengguna memiliki akses fitur yang berbeda sesuai kebutuhan</p>
        </div>

        <!-- Role Tabs -->
        <div class="role-tabs">
            <div class="role-tab active" onclick="switchRole('admin')">
                <i class="fas fa-user-shield"></i>
                Admin
            </div>
            <div class="role-tab" onclick="switchRole('petugas')">
                <i class="fas fa-user-tie"></i>
                Petugas
            </div>
            <div class="role-tab" onclick="switchRole('siswa')">
                <i class="fas fa-user-graduate"></i>
                Siswa
            </div>
        </div>

        <!-- Admin Features -->
        <div id="admin-features" class="feature-content active">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-user-graduate"></i></div>
                    <h3>CRUD Data Siswa</h3>
                    <p>Kelola data siswa secara lengkap: tambah, lihat, edit, dan hapus informasi siswa.</p>
                    <span class="feature-badge">CRUD</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-school"></i></div>
                    <h3>CRUD Data Kelas</h3>
                    <p>Manajemen kelas dengan fitur create, read, update, dan delete data kelas.</p>
                    <span class="feature-badge">CRUD</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                    <h3>CRUD Data SPP</h3>
                    <p>Atur nominal SPP, periode pembayaran, dan kelola seluruh data SPP.</p>
                    <span class="feature-badge">CRUD</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-credit-card"></i></div>
                    <h3>Pembayaran</h3>
                    <p>Proses dan validasi transaksi pembayaran SPP dari siswa.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-chart-bar"></i></div>
                    <h3>Laporan</h3>
                    <p>Generate laporan keuangan lengkap dengan berbagai filter dan periode.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-users-cog"></i></div>
                    <h3>Data Petugas</h3>
                    <p>Kelola akun petugas, hak akses, dan monitoring aktivitas petugas.</p>
                    <span class="feature-badge">CRUD</span>
                </div>
            </div>
        </div>

        <!-- Petugas Features -->
        <div id="petugas-features" class="feature-content">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-user-graduate"></i></div>
                    <h3>Data Siswa</h3>
                    <p>Melihat informasi lengkap siswa dan riwayat pembayaran mereka.</p>
                    <span class="feature-badge" style="background: #e3f2fd; color: #1565c0;">Read Only</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-school"></i></div>
                    <h3>Data Kelas</h3>
                    <p>Akses informasi kelas untuk keperluan monitoring dan pembayaran.</p>
                    <span class="feature-badge" style="background: #e3f2fd; color: #1565c0;">Read Only</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                    <h3>Data SPP</h3>
                    <p>Melihat nominal dan periode SPP untuk setiap kelas.</p>
                    <span class="feature-badge" style="background: #e3f2fd; color: #1565c0;">Read Only</span>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-credit-card"></i></div>
                    <h3>Pembayaran</h3>
                    <p>Memproses dan memvalidasi transaksi pembayaran SPP siswa.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-chart-bar"></i></div>
                    <h3>Laporan</h3>
                    <p>Melihat dan mencetak laporan pembayaran untuk keperluan monitoring.</p>
                </div>
            </div>
        </div>

        <!-- Siswa Features -->
        <div id="siswa-features" class="feature-content">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-history"></i></div>
                    <h3>Riwayat Pembayaran</h3>
                    <p>Lihat seluruh riwayat pembayaran SPP Anda dengan detail lengkap dan status terkini.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-id-card"></i></div>
                    <h3>Profil Siswa</h3>
                    <p>Kelola dan perbarui informasi profil pribadi Anda.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-file-invoice-dollar"></i></div>
                    <h3>Status Tagihan</h3>
                    <p>Cek status pembayaran dan tagihan SPP yang harus dibayar.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-circle"><i class="fas fa-print"></i></div>
                    <h3>Cetak Bukti Bayar</h3>
                    <p>Download dan cetak bukti pembayaran SPP untuk keperluan arsip.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="login" class="login-section scroll-reveal">
        <div class="section-header">
            <h2>Pilih Portal Login</h2>
            <p>Akses akun sesuai dengan peran Anda</p>
        </div>
        <div class="login-grid">
            <a href="{{ route('login.form') }}" class="login-card">
                <div class="feature-icon-circle" style="background: var(--light-green); margin-bottom: 25px;"><i class="fas fa-user-tie"></i></div>
                <h3>Portal Admin & Petugas</h3>
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

    <section id="faq" class="faq-section scroll-reveal">
        <div class="faq-container">
            <div class="section-header">
                <h2>Pertanyaan Umum</h2>
                <p>Cari tahu hal yang sering ditanyakan di sini</p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Apa itu SPP-PAY?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    SPP-PAY adalah platform manajemen pembayaran SPP digital yang memudahkan sekolah dalam mengelola data siswa, pembayaran, dan laporan keuangan secara terintegrasi. Sistem ini dirancang untuk meningkatkan efisiensi administrasi dan transparansi keuangan sekolah.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apa perbedaan akses antara Admin dan Petugas?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Admin memiliki akses penuh untuk mengelola semua data (CRUD) termasuk data petugas, siswa, kelas, dan SPP. Sedangkan Petugas hanya dapat melihat data (Read Only) dan memproses pembayaran tanpa dapat mengedit data master. Ini untuk menjaga keamanan dan integritas data sekolah.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara siswa melakukan pembayaran SPP?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Siswa dapat melakukan pembayaran dengan datang langsung ke bagian petugas/tata usaha sekolah. Petugas akan memvalidasi pembayaran dan mencatat transaksi di sistem. Bukti pembayaran dapat dicetak atau diunduh melalui Portal Siswa.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah saya bisa melihat riwayat pembayaran?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Ya, siswa dapat login ke Portal Siswa untuk melihat seluruh riwayat transaksi pembayaran SPP yang sudah tervalidasi oleh petugas. Riwayat lengkap termasuk tanggal pembayaran, nominal, dan status pembayaran dapat diakses kapan saja.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara mencetak bukti pembayaran?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Siswa dapat mencetak bukti pembayaran melalui Portal Siswa. Setelah login, pilih menu "Riwayat Pembayaran" dan klik tombol cetak pada transaksi yang diinginkan. Bukti pembayaran dapat diunduh dalam format PDF untuk keperluan arsip.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah data pembayaran aman?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Ya, sangat aman. SPP-PAY menggunakan sistem keamanan berlapis dengan enkripsi data untuk melindungi semua informasi pribadi dan transaksi keuangan. Setiap akses ke sistem juga direkam dan dimonitor untuk mencegah penyalahgunaan.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana jika lupa password?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Jika lupa password, siswa dapat menghubungi petugas atau admin sekolah untuk mereset password. Untuk admin dan petugas, silakan hubungi administrator sistem atau IT support sekolah untuk bantuan reset password.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah ada biaya untuk menggunakan sistem ini?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Tidak ada biaya tambahan untuk siswa. SPP-PAY adalah sistem internal sekolah yang disediakan untuk memudahkan proses pembayaran dan administrasi. Semua fitur dapat diakses secara gratis oleh siswa, petugas, dan admin yang terdaftar.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara mengetahui status tagihan SPP saya?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Login ke Portal Siswa dan lihat menu "Status Tagihan" untuk mengetahui tagihan SPP yang belum dibayar, jumlah tunggakan (jika ada), dan periode pembayaran. Status akan diperbarui secara real-time setelah pembayaran divalidasi oleh petugas.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana jika terjadi kesalahan data atau pembayaran?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Silakan segera hubungi admin sekolah melalui bagian Tata Usaha atau datang langsung ke sekolah dengan membawa bukti pembayaran. Admin akan memeriksa dan memperbaiki kesalahan data secepatnya untuk memastikan akurasi catatan pembayaran Anda.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Apakah orang tua bisa mengakses sistem ini?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Orang tua dapat menggunakan akun siswa untuk memantau riwayat pembayaran dan status tagihan anak mereka. Akun siswa dapat diakses dari perangkat mana saja dengan koneksi internet, sehingga orang tua dapat dengan mudah memantau pembayaran SPP.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Jam operasional sistem SPP-PAY?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    Sistem SPP-PAY dapat diakses 24/7 untuk melihat riwayat pembayaran dan status tagihan. Namun untuk proses pembayaran fisik, sesuaikan dengan jam operasional bagian Tata Usaha sekolah (umumnya Senin-Jumat, 07:00-15:00).
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
                    <a href="https://www.facebook.com/share/1GeFVE1iWt/" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/mznlmrfddd_?igsh=aWRzMTY4bWlrc3Fj" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/qr/EHUXOWEZPKGDL1" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Navigasi</h3>
                <ul class="footer-links">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
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
        // ========== PAGE LOADER ========== 
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('pageLoader').classList.add('hidden');
            }, 500);
        });

        // ========== NAVBAR SCROLL EFFECT ========== 
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ========== SCROLL REVEAL ANIMATION ========== 
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');
            
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const revealPoint = 100;
                
                if (elementTop < windowHeight - revealPoint) {
                    element.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check

        // ========== HERO SLIDESHOW SCRIPT ==========
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const navButtons = document.querySelectorAll('.hero-nav-btn');
        let autoSlide;

        function changeSlide(index) {
            slides[currentSlide].classList.remove('active');
            navButtons[currentSlide].classList.remove('active');
            
            currentSlide = index;
            
            slides[currentSlide].classList.add('active');
            navButtons[currentSlide].classList.add('active');
            
            clearInterval(autoSlide);
            startAutoSlide();
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            changeSlide(next);
        }

        function startAutoSlide() {
            autoSlide = setInterval(nextSlide, 5000);
        }

        startAutoSlide();

        // ========== ROLE SWITCHING SCRIPT ==========
        function switchRole(role) {
            document.querySelectorAll('.feature-content').forEach(content => {
                content.classList.remove('active');
            });

            document.querySelectorAll('.role-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(`${role}-features`).classList.add('active');
            event.target.closest('.role-tab').classList.add('active');
        }

        // ========== FAQ ACCORDION SCRIPT ==========
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                item.classList.toggle('active');
            });
        });

        // ========== ALERT NOTIFICATION SCRIPT ==========
        function closeAlert() {
            const alert = document.getElementById('alertNotification');
            if (alert) {
                alert.classList.add('hiding');
                setTimeout(() => {
                    alert.style.display = 'none';
                    alert.classList.remove('hiding');
                }, 300);
            }
        }

        // ========== SMOOTH SCROLL FOR ANCHOR LINKS ==========
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // ========== MOUSE PARALLAX EFFECT FOR HERO ==========
        document.addEventListener('mousemove', (e) => {
            const hero = document.querySelector('.hero');
            if (!hero) return;
            
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            const badge = document.querySelector('.hero-badge');
            const title = document.querySelector('.hero h1');
            const subtitle = document.querySelector('.hero p');
            
            if (badge) {
                badge.style.transform = `translate(${mouseX * 20}px, ${mouseY * 20}px)`;
            }
            if (title) {
                title.style.transform = `translate(${mouseX * 15}px, ${mouseY * 15}px)`;
            }
            if (subtitle) {
                subtitle.style.transform = `translate(${mouseX * 10}px, ${mouseY * 10}px)`;
            }
        });
    </script>
</body>
</html>
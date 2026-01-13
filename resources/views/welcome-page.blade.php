<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP Management System</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fef9e7 0%, #d5f4e6 50%, #abebc6 100%);
            min-height: 100vh;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative blurred circles */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(82, 190, 128, 0.3) 0%, rgba(82, 190, 128, 0) 70%);
            border-radius: 50%;
            top: -150px;
            right: -150px;
            filter: blur(60px);
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(249, 231, 159, 0.4) 0%, rgba(249, 231, 159, 0) 70%);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            filter: blur(80px);
            animation: float 10s ease-in-out infinite reverse;
        }

        /* Additional blur elements */
        .blur-circle-1 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(171, 235, 198, 0.3) 0%, rgba(171, 235, 198, 0) 70%);
            border-radius: 50%;
            top: 50%;
            right: 10%;
            filter: blur(70px);
            animation: float 12s ease-in-out infinite;
        }

        .blur-circle-2 {
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(244, 208, 63, 0.25) 0%, rgba(244, 208, 63, 0) 70%);
            border-radius: 50%;
            bottom: 30%;
            left: 15%;
            filter: blur(90px);
            animation: float 9s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        .container {
            text-align: center;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            margin-bottom: 60px;
            animation: fadeInDown 1s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            box-shadow: 0 10px 30px rgba(82, 190, 128, 0.3);
            animation: pulse 2s ease-in-out infinite;
            color: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 10px 30px rgba(82, 190, 128, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(82, 190, 128, 0.4); }
        }

        .header h1 {
            font-size: 56px;
            background: linear-gradient(135deg, #27ae60 0%, #f39c12 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
        }

        .header p {
            font-size: 22px;
            color: #52be80;
            font-weight: 500;
        }

        .login-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(82, 190, 128, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out;
            animation-fill-mode: both;
            border: 1px solid rgba(82, 190, 128, 0.1);
        }

        .login-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .login-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #52be80 0%, #f9e79f 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .login-card:hover::before {
            transform: scaleX(1);
        }

        .login-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(82, 190, 128, 0.25);
            background: rgba(255, 255, 255, 1);
        }

        .login-card.petugas:hover .login-icon {
            background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
            transform: scale(1.1) rotate(5deg);
        }

        .login-card.siswa:hover .login-icon {
            background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
            transform: scale(1.1) rotate(-5deg);
        }

        .login-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            transition: all 0.4s ease;
            position: relative;
            color: white;
        }

        .login-card.petugas .login-icon {
            background: linear-gradient(135deg, #abebc6 0%, #52be80 100%);
            box-shadow: 0 10px 30px rgba(82, 190, 128, 0.3);
        }

        .login-card.siswa .login-icon {
            background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
            box-shadow: 0 10px 30px rgba(249, 231, 159, 0.4);
        }

        .login-card h2 {
            font-size: 32px;
            margin-bottom: 15px;
            color: #2c3e50;
            font-weight: 600;
        }

        .login-card p {
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .btn-login {
            display: inline-block;
            padding: 16px 45px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-card.petugas .btn-login {
            background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
            box-shadow: 0 8px 20px rgba(82, 190, 128, 0.3);
        }

        .login-card.siswa .btn-login {
            background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
            box-shadow: 0 8px 20px rgba(249, 231, 159, 0.4);
            color: #7d6608;
        }

        .btn-login:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(82, 190, 128, 0.4);
        }

        .btn-login::before {
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

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login span {
            position: relative;
            z-index: 1;
        }

        .footer {
            color: #52be80;
            font-size: 14px;
            margin-top: 50px;
            animation: fadeIn 2s ease-out;
        }

        .footer-links {
            margin-top: 10px;
            color: #7f8c8d;
            font-size: 13px;
        }

        /* Info Section */
        .info-section {
            margin: 50px 0;
            animation: fadeInUp 1s ease-out 0.6s;
            animation-fill-mode: both;
        }

        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px 25px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(82, 190, 128, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            border: 1px solid rgba(82, 190, 128, 0.1);
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(82, 190, 128, 0.15);
            background: rgba(255, 255, 255, 1);
        }

        .info-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #d5f4e6 0%, #fef9e7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            transition: all 0.5s ease;
            color: #52be80;
        }

        .info-card:hover .info-icon {
            background: linear-gradient(135deg, #abebc6 0%, #f9e79f 100%);
            transform: rotate(360deg) scale(1.1);
            color: #27ae60;
        }

        .info-card h3 {
            font-size: 20px;
            color: #27ae60;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .info-card p {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.6;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 30px 15px;
            }

            .header h1 {
                font-size: 36px;
            }

            .header p {
                font-size: 18px;
            }

            .login-options {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .login-card {
                padding: 40px 30px;
            }

            .login-icon {
                width: 100px;
                height: 100px;
                font-size: 45px;
            }

            .login-card h2 {
                font-size: 26px;
            }

            .info-cards {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="blur-circle-1"></div>
    <div class="blur-circle-2"></div>
    
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-wallet"></i>
            </div>
            <h1>SPP Management</h1>
            <p>Sistem Informasi Pembayaran SPP Sekolah</p>
        </div>

        <div class="login-options">
            <!-- Login Petugas/Admin -->
            <a href="{{ route('login.form') }}" class="login-card petugas">
                <div class="login-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h2>Login Petugas</h2>
                <p>Untuk Admin dan Petugas yang mengelola sistem pembayaran SPP</p>
                <span class="btn-login">
                    <span>Masuk Sebagai Petugas <i class="fas fa-arrow-right"></i></span>
                </span>
            </a>

            <!-- Login Siswa -->
            <a href="{{ route('siswa.login.form') }}" class="login-card siswa">
                <div class="login-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h2>Login Siswa</h2>
                <p>Untuk Siswa yang ingin melihat riwayat pembayaran SPP</p>
                <span class="btn-login">
                    <span>Masuk Sebagai Siswa <i class="fas fa-arrow-right"></i></span>
                </span>
            </a>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Cepat & Mudah</h3>
                    <p>Proses pembayaran SPP yang cepat dan mudah dipahami</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data pembayaran Anda tersimpan dengan aman</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Laporan Lengkap</h3>
                    <p>Riwayat pembayaran tersedia secara real-time</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>© 2026 SPP Management System. All rights reserved.</p>
            <div class="footer-links">
                <span> Dibuat dengan cinta untuk pendidikan Indonesia</span>
            </div>
        </div>
    </div>
</body>
</html>
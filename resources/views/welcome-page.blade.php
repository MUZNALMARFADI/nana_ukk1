<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        .header {
            color: white;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 48px;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .header p {
            font-size: 20px;
            opacity: 0.95;
        }

        .login-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .login-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 70px rgba(0,0,0,0.4);
        }

        .login-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }

        .login-card.petugas .login-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-card.siswa .login-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .login-card h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .login-card p {
            color: #7f8c8d;
            margin-bottom: 25px;
            font-size: 16px;
        }

        .btn-login {
            display: inline-block;
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.3s;
        }

        .login-card.petugas .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-card.siswa .btn-login {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .btn-login:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .footer {
            color: white;
            font-size: 14px;
            opacity: 0.8;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 32px;
            }

            .header p {
                font-size: 16px;
            }

            .login-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💰 SPP Management</h1>
            <p>Sistem Informasi Pembayaran SPP Sekolah</p>
        </div>

        <div class="login-options">
            <!-- Login Petugas/Admin -->
            <a href="{{ route('login.form') }}" class="login-card petugas">
                <div class="login-icon">
                    👨‍💼
                </div>
                <h2>Login Petugas</h2>
                <p>Untuk Admin dan Petugas yang mengelola sistem pembayaran SPP</p>
                <span class="btn-login">Masuk Sebagai Petugas →</span>
            </a>

            <!-- Login Siswa -->
            <a href="{{ route('siswa.login.form') }}" class="login-card siswa">
                <div class="login-icon">
                    👨‍🎓
                </div>
                <h2>Login Siswa</h2>
                <p>Untuk Siswa yang ingin melihat riwayat pembayaran SPP</p>
                <span class="btn-login">Masuk Sebagai Siswa →</span>
            </a>
        </div>

        <div class="footer">
            <p>© 2026 SPP Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
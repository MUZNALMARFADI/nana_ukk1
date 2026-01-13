<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPP Management</title>
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
            padding: 20px;
            position: relative;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
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

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, -20px); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(82, 190, 128, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-header {
            background: linear-gradient(135deg, #abebc6 0%, #f9e79f 100%);
            color: #27ae60;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #27ae60;
            position: relative;
            z-index: 1;
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #27ae60;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 14px;
            color: #229954;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #27ae60;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #52be80;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #d5f4e6;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fefefe;
        }

        .form-control:focus {
            outline: none;
            border-color: #52be80;
            box-shadow: 0 0 0 3px rgba(82, 190, 128, 0.1);
            background: white;
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(82, 190, 128, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i,
        .btn-login span {
            position: relative;
            z-index: 1;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .alert-success {
            background: #d5f4e6;
            color: #1e8449;
            border: 1px solid #abebc6;
        }

        .alert-error {
            background: #fadbd8;
            color: #922b21;
            border: 1px solid #f5b7b1;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background: #fef9e7;
            color: #52be80;
            font-size: 13px;
        }

        .demo-info {
            background: linear-gradient(135deg, #fef9e7 0%, #fff9e6 100%);
            padding: 18px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 13px;
            color: #d4ac0d;
            border: 1px solid #f9e79f;
            box-shadow: 0 4px 15px rgba(249, 231, 159, 0.2);
        }

        .demo-info strong {
            display: block;
            margin-bottom: 10px;
            color: #b7950b;
            font-size: 14px;
        }

        .demo-info p {
            margin: 8px 0;
            color: #7d6608;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .demo-info i {
            color: #52be80;
            font-size: 14px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #52be80;
            user-select: none;
            z-index: 1;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #27ae60;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .header-icon {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="header-icon">
                <i class="fas fa-wallet"></i>
            </div>
            <h1>SPP Management</h1>
            <p>Sistem Pembayaran SPP Sekolah</p>
        </div>

        <div class="login-body">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            class="form-control @error('username') is-invalid @enderror" 
                            value="{{ old('username') }}" 
                            placeholder="Masukkan username"
                            autofocus
                        >
                    </div>
                    @error('username')
                    <span class="invalid-feedback"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Masukkan password"
                        >
                        <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
                    </div>
                    @error('password')
                    <span class="invalid-feedback"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> <span>Login Sekarang</span>
                </button>
            </form>

            <div class="demo-info">
                <strong><i class="fas fa-key"></i> Demo Login:</strong>
                <p><i class="fas fa-user-shield"></i> <strong>Admin:</strong> admin / admin123</p>
                <p><i class="fas fa-user-tie"></i> <strong>Petugas:</strong> petugas1 / petugas123</p>
            </div>
        </div>

        <div class="login-footer">
            <i class="fas fa-copyright"></i> 2026 SPP Management System. All rights reserved.
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
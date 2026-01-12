<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SPP Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 14px;
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
            color: #2c3e50;
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
            font-size: 18px;
            color: #7f8c8d;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #43e97b;
            box-shadow: 0 0 0 3px rgba(67, 233, 123, 0.1);
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
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(67, 233, 123, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
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
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #7f8c8d;
            font-size: 13px;
        }

        .demo-info {
            background: #fff3cd;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 13px;
            color: #856404;
        }

        .demo-info strong {
            display: block;
            margin-bottom: 8px;
        }

        .demo-info p {
            margin: 5px 0;
        }

        .link-petugas {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .link-petugas a {
            color: #43e97b;
            text-decoration: none;
            font-weight: 500;
        }

        .link-petugas a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>👨‍🎓 Portal Siswa</h1>
            <p>Cek Pembayaran SPP Anda</p>
        </div>

        <div class="login-body">
            @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <form action="{{ route('siswa.login.submit') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🎓</span>
                        <input 
                            type="text" 
                            name="nisn" 
                            id="nisn" 
                            class="form-control @error('nisn') is-invalid @enderror" 
                            value="{{ old('nisn') }}" 
                            placeholder="10 digit NISN"
                            maxlength="10"
                            autofocus
                        >
                    </div>
                    @error('nisn')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔢</span>
                        <input 
                            type="text" 
                            name="nis" 
                            id="nis" 
                            class="form-control @error('nis') is-invalid @enderror" 
                            value="{{ old('nis') }}"
                            placeholder="8 digit NIS"
                            maxlength="8"
                        >
                    </div>
                    @error('nis')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    🚀 Login Sekarang
                </button>
            </form>

            <div class="demo-info">
                <strong>ℹ️ Informasi Login:</strong>
                <p>Gunakan NISN dan NIS Anda untuk login</p>
                <p>Contoh: NISN: 9925000001, NIS: 20250001</p>
            </div>

            <div class="link-petugas">
                <p>Login sebagai petugas? <a href="{{ route('login.form') }}">Klik disini</a></p>
            </div>
        </div>

        <div class="login-footer">
            © 2026 SPP Management System. All rights reserved.
        </div>
    </div>
</body>
</html>
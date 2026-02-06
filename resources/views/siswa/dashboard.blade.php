<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SPP Management</title>
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
            background: linear-gradient(135deg, #f8fdf8 0%, #e8f5e9 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 20s ease-in-out infinite;
            z-index: 0;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #81c784, #66bb6a);
            top: -200px;
            right: -200px;
            animation-delay: 0s;
        }

        .bg-orb-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #fff59d, #fdd835);
            bottom: -150px;
            left: -150px;
            animation-delay: 5s;
        }

        .bg-orb-3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #a5d6a7, #81c784);
            top: 50%;
            left: 50%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(20px, 30px) scale(1.05); }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Header Section */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(46, 125, 50, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(129, 199, 132, 0.2);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #66bb6a, #81c784, #fdd835);
        }

        .header-left h1 {
            font-size: 28px;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
        }

        .header-left p {
            color: #7f8c8d;
            font-size: 15px;
            margin-left: 40px;
        }

        .logout-btn {
            padding: 12px 28px;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        /* Profile Card - Redesigned dengan Kotak Hijau */
        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 0;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(46, 125, 50, 0.1);
            margin-bottom: 30px;
            border: 1px solid rgba(129, 199, 132, 0.2);
            overflow: hidden;
        }

        /* Kotak Hijau untuk Profil */
        .profile-green-box {
            background: linear-gradient(135deg, #66bb6a 0%, #81c784 50%, #a5d6a7 100%);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .profile-green-box::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .profile-green-box::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 25px;
            position: relative;
            z-index: 1;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #2e7d32;
            font-weight: bold;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h2 {
            font-size: 32px;
            color: white;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info .class-info {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .profile-info .class-info i {
            font-size: 18px;
        }

        /* Profile Details - 2 Kolom */
        .profile-content {
            padding: 30px 40px 40px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detail-item {
            padding: 25px;
            background: linear-gradient(135deg, #f1f8e9 0%, #fff 100%);
            border-radius: 15px;
            border: 1px solid #c8e6c9;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.1);
            border-color: #81c784;
        }

        .detail-item label {
            display: block;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .detail-item .value {
            font-size: 18px;
            color: #2e7d32;
            font-weight: 600;
        }

        /* Stats Grid - Enhanced */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(46, 125, 50, 0.1);
            border: 1px solid rgba(129, 199, 132, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(129, 199, 132, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(46, 125, 50, 0.15);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
        }

        .stat-icon.yellow {
            background: linear-gradient(135deg, #fdd835 0%, #f9a825 100%);
        }

        .stat-icon.lime {
            background: linear-gradient(135deg, #9ccc65 0%, #7cb342 100%);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Payment History - Enhanced Table */
        .payment-history {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(46, 125, 50, 0.1);
            border: 1px solid rgba(129, 199, 132, 0.2);
        }

        .payment-history h2 {
            font-size: 24px;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(46, 125, 50, 0.05);
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
        }

        .table thead {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
        }

        .table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 700;
            color: #2e7d32;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #c8e6c9;
        }

        .table th:first-child {
            border-top-left-radius: 15px;
        }

        .table th:last-child {
            border-top-right-radius: 15px;
        }

        .table td {
            padding: 18px 20px;
            border-bottom: 1px solid #e8f5e9;
            font-size: 14px;
            color: #2f4f4f;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, #f1f8e9 0%, #fff 100%);
            transform: scale(1.01);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }

        .table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            color: #1b5e20;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .empty-state h3 {
            font-size: 22px;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 15px;
        }

        /* Alert */
        .alert {
            padding: 18px 24px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 5px 20px rgba(46, 125, 50, 0.1);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            color: #1b5e20;
            border: 1px solid #81c784;
        }

        .alert i {
            font-size: 20px;
        }

        /* Number formatting in table */
        .amount {
            font-weight: 700;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
                padding: 25px;
            }

            .header-left h1 {
                font-size: 24px;
                justify-content: center;
            }

            .header-left p {
                margin-left: 0;
            }

            .profile-green-box {
                padding: 30px 20px;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-info h2 {
                font-size: 26px;
            }

            .profile-content {
                padding: 20px;
            }

            .profile-details {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .payment-history {
                padding: 25px 20px;
            }

            .table {
                font-size: 12px;
            }

            .table th, .table td {
                padding: 12px 10px;
            }

            .stat-card .value {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background Orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1><i class="fas fa-user-graduate"></i> Dashboard Siswa</h1>
                <p>Selamat datang di portal pembayaran SPP</p>
            </div>
            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Kotak Hijau dengan Profil -->
            <div class="profile-green-box">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                    </div>
                    <div class="profile-info">
                        <h2>{{ $siswa->nama }}</h2>
                        <div class="class-info">
                            <i class="fas fa-school"></i>
                            <span>{{ $siswa->kelas->nama_kelas ?? '-' }} - {{ $siswa->kelas->kompetensi_keahlian ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail dalam 2 Kolom -->
            <div class="profile-content">
                <div class="profile-details">
                    <div class="detail-item">
                        <label><i class="fas fa-id-card"></i> NISN</label>
                        <div class="value">{{ $siswa->nisn }}</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-hashtag"></i> NIS</label>
                        <div class="value">{{ $siswa->nis }}</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-phone"></i> No. Telepon</label>
                        <div class="value">{{ $siswa->no_telp }}</div>
                    </div>
                    <div class="detail-item">
                        <label><i class="fas fa-map-marker-alt"></i> Alamat</label>
                        <div class="value">{{ $siswa->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3>Total Pembayaran</h3>
                <div class="value">Rp {{ number_format($totalBayar, 0, ',', '.') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Pembayaran Tahun Ini</h3>
                <div class="value">Rp {{ number_format($bayarTahunIni, 0, ',', '.') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon lime">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Bulan Terbayar ({{ date('Y') }})</h3>
                <div class="value">{{ $bulanDibayar }} / 12 Bulan</div>
            </div>
        </div>

        <!-- Payment History -->
        <div class="payment-history">
            <h2><i class="fas fa-history"></i> Riwayat Pembayaran</h2>

            @if($pembayaran->count() > 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> No</th>
                            <th><i class="fas fa-calendar"></i> Tanggal Bayar</th>
                            <th><i class="fas fa-calendar-day"></i> Bulan</th>
                            <th><i class="fas fa-calendar-alt"></i> Tahun</th>
                            <th><i class="fas fa-money-bill"></i> Jumlah Bayar</th>
                            <th><i class="fas fa-user-tie"></i> Petugas</th>
                            <th><i class="fas fa-check-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $index => $item)
                        <tr>
                            <td><strong>{{ $index + 1 }}</strong></td>
                            <td>{{ $item->tgl_bayar->format('d M Y') }}</td>
                            <td>{{ $item->bulan_dibayar }}</td>
                            <td>{{ $item->tahun_dibayar }}</td>
                            <td><span class="amount">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</span></td>
                            <td>{{ $item->petugas->nama_petugas ?? '-' }}</td>
                            <td><span class="badge badge-success"><i class="fas fa-check"></i> Lunas</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3>Belum Ada Riwayat Pembayaran</h3>
                <p>Anda belum memiliki riwayat pembayaran SPP</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
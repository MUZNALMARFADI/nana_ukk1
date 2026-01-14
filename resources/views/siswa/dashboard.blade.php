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
            background: linear-gradient(135deg, #fef9e7 0%, #d5f4e6 50%, #abebc6 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative blur elements */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(249, 231, 159, 0.3) 0%, rgba(249, 231, 159, 0) 70%);
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
            background: radial-gradient(circle, rgba(82, 190, 128, 0.3) 0%, rgba(82, 190, 128, 0) 70%);
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(82, 190, 128, 0.15);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #d5f4e6;
        }

        .header-left h1 {
            font-size: 24px;
            color: #27ae60;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-left p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(82, 190, 128, 0.15);
            margin-bottom: 30px;
            border: 2px solid #d5f4e6;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            font-weight: bold;
        }

        .profile-info h2 {
            font-size: 24px;
            color: #27ae60;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #7f8c8d;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-item {
            padding: 15px;
            background: linear-gradient(135deg, #fef9e7 0%, #d5f4e6 100%);
            border-radius: 10px;
            border: 1px solid #abebc6;
        }

        .detail-item label {
            display: block;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-item .value {
            font-size: 16px;
            color: #27ae60;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(82, 190, 128, 0.15);
            border: 2px solid #d5f4e6;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(82, 190, 128, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            margin-bottom: 15px;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #abebc6 0%, #52be80 100%);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #27ae60;
        }

        .payment-history {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(82, 190, 128, 0.15);
            border: 2px solid #d5f4e6;
        }

        .payment-history h2 {
            font-size: 20px;
            color: #27ae60;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #d5f4e6 0%, #fef9e7 100%);
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #27ae60;
            font-size: 14px;
            border-bottom: 2px solid #abebc6;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #d5f4e6;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #fef9e7;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: #d5f4e6;
            color: #1e8449;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
            color: #d5f4e6;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d5f4e6;
            color: #1e8449;
            border: 1px solid #abebc6;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table {
                font-size: 12px;
            }

            .table th, .table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
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
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <h2>{{ $siswa->nama }}</h2>
                    <p><i class="fas fa-school"></i> {{ $siswa->kelas->nama_kelas ?? '-' }} - {{ $siswa->kelas->kompetensi_keahlian ?? '-' }}</p>
                </div>
            </div>

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
                <div class="stat-icon blue">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Pembayaran Tahun Ini</h3>
                <div class="value">Rp {{ number_format($bayarTahunIni, 0, ',', '.') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">
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
            <div style="overflow-x: auto;">
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
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->tgl_bayar->format('d M Y') }}</td>
                            <td>{{ $item->bulan_dibayar }}</td>
                            <td>{{ $item->tahun_dibayar }}</td>
                            <td><strong style="color: #27ae60;">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></td>
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
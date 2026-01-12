<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SPP Management</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h1 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .header-left p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
        }

        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
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
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }

        .profile-info h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .detail-item label {
            display: block;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item .value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .payment-history {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .payment-history h2 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: #f8f9fa;
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
            font-size: 14px;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
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
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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
                <h1>👨‍🎓 Dashboard Siswa</h1>
                <p>Selamat datang di portal pembayaran SPP</p>
            </div>
            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <span>✅</span>
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
                    <p>{{ $siswa->kelas->nama_kelas ?? '-' }} - {{ $siswa->kelas->kompetensi_keahlian ?? '-' }}</p>
                </div>
            </div>

            <div class="profile-details">
                <div class="detail-item">
                    <label>NISN</label>
                    <div class="value">{{ $siswa->nisn }}</div>
                </div>
                <div class="detail-item">
                    <label>NIS</label>
                    <div class="value">{{ $siswa->nis }}</div>
                </div>
                <div class="detail-item">
                    <label>No. Telepon</label>
                    <div class="value">{{ $siswa->no_telp }}</div>
                </div>
                <div class="detail-item">
                    <label>Alamat</label>
                    <div class="value">{{ $siswa->alamat }}</div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon green">💰</div>
                <h3>Total Pembayaran</h3>
                <div class="value">Rp {{ number_format($totalBayar, 0, ',', '.') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon blue">📅</div>
                <h3>Pembayaran Tahun Ini</h3>
                <div class="value">Rp {{ number_format($bayarTahunIni, 0, ',', '.') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">✅</div>
                <h3>Bulan Terbayar ({{ date('Y') }})</h3>
                <div class="value">{{ $bulanDibayar }} / 12 Bulan</div>
            </div>
        </div>

        <!-- Payment History -->
        <div class="payment-history">
            <h2>📋 Riwayat Pembayaran</h2>

            @if($pembayaran->count() > 0)
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah Bayar</th>
                            <th>Petugas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->tgl_bayar->format('d M Y') }}</td>
                            <td>{{ $item->bulan_dibayar }}</td>
                            <td>{{ $item->tahun_dibayar }}</td>
                            <td><strong>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></td>
                            <td>{{ $item->petugas->nama_petugas ?? '-' }}</td>
                            <td><span class="badge badge-success">✓ Lunas</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <h3>Belum Ada Riwayat Pembayaran</h3>
                <p>Anda belum memiliki riwayat pembayaran SPP</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
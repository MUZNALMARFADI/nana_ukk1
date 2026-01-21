@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>Total Siswa</h3>
            <p>{{ $totalSiswa }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-school"></i>
        </div>
        <div class="stat-info">
            <h3>Total Kelas</h3>
            <p>{{ $totalKelas }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <h3>Total Pembayaran</h3>
            <p>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <h3>Bulan Ini</h3>
            <p>Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h2 style="margin-bottom: 20px; color: #27ae60; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-chart-pie"></i> Ringkasan Sistem
        </h2>
        <p style="color: #7f8c8d; margin-bottom: 30px; line-height: 1.6;">
            <i class="fas fa-hand-sparkles" style="color: #52be80;"></i> Selamat datang di Sistem Manajemen Pembayaran SPP. Gunakan menu di bawah untuk navigasi cepat.
        </p>

        <div class="menu-grid">
            <a href="{{ route('siswa.index') }}" class="menu-card">
                <div class="menu-icon blue-gradient">
                    <i class="fas fa-users"></i>
                </div>
                <strong>Kelola Siswa</strong>
                <p>Manajemen data siswa</p>
            </a>

            <a href="{{ route('pembayaran.index') }}" class="menu-card">
                <div class="menu-icon yellow-gradient">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <strong>Pembayaran SPP</strong>
                <p>Input & kelola pembayaran</p>
            </a>

            <a href="{{ route('kelas.index') }}" class="menu-card">
                <div class="menu-icon green-gradient">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <strong>Data Kelas</strong>
                <p>Manajemen data kelas</p>
            </a>

            <a href="{{ route('spp.index') }}" class="menu-card">
                <div class="menu-icon orange-gradient">
                    <i class="fas fa-coins"></i>
                </div>
                <strong>Kelola SPP</strong>
                <p>Atur nominal SPP</p>
            </a>
        </div>
    </div>
</div>

<style>
    /* Stats Grid - 2x2 Layout */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 30px;
        max-width: 1200px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e8f5e9;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(39, 174, 96, 0.15);
        border-color: #52be80;
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08);
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        box-shadow: 0 4px 12px rgba(82, 190, 128, 0.3);
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #f4d03f 0%, #f39c12 100%);
        box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    .stat-icon.purple {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    }

    .stat-info {
        flex: 1;
    }

    .stat-info h3 {
        font-size: 13px;
        color: #95a5a6;
        margin: 0 0 6px 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-info p {
        font-size: 26px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        line-height: 1.2;
    }

    /* Menu Grid - 2x2 Layout */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        max-width: 1200px;
    }

    .menu-card {
        padding: 28px 20px;
        background: white;
        border: 2px solid #e8f5e9;
        border-radius: 16px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #52be80 0%, #27ae60 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .menu-card:hover::before {
        transform: scaleX(1);
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(39, 174, 96, 0.15);
        border-color: #52be80;
    }

    .menu-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 18px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        transition: all 0.3s ease;
    }

    .menu-icon.blue-gradient {
        background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        box-shadow: 0 6px 16px rgba(82, 190, 128, 0.25);
    }

    .menu-icon.yellow-gradient {
        background: linear-gradient(135deg, #f4d03f 0%, #f39c12 100%);
        box-shadow: 0 6px 16px rgba(243, 156, 18, 0.25);
    }

    .menu-icon.green-gradient {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        box-shadow: 0 6px 16px rgba(52, 152, 219, 0.25);
    }

    .menu-icon.orange-gradient {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        box-shadow: 0 6px 16px rgba(231, 76, 60, 0.25);
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.1) rotate(3deg);
    }

    .menu-card strong {
        display: block;
        color: #2c3e50;
        font-size: 17px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .menu-card p {
        color: #95a5a6;
        font-size: 13px;
        margin: 0;
        line-height: 1.4;
    }

    /* Card */
    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #e8f5e9;
    }

    .card-body {
        padding: 32px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .menu-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-card {
            padding: 20px;
        }

        .menu-card {
            padding: 24px 16px;
        }

        .card-body {
            padding: 24px;
        }
    }
</style>
@endsection
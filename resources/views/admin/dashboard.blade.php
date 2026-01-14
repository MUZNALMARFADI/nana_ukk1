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
            <i class="fas fa-hand-sparkles" style="color: #52be80;"></i> Selamat datang di Sistem Manajemen Pembayaran SPP. Gunakan menu di sebelah kiri untuk navigasi.
        </p>

        <div class="menu-grid">
            <a href="{{ route('siswa.index') }}" class="menu-card">
                <div class="menu-icon" style="background: linear-gradient(135deg, #d5f4e6 0%, #abebc6 100%);">
                    <i class="fas fa-users"></i>
                </div>
                <strong>Kelola Siswa</strong>
                <p>Manajemen data siswa</p>
            </a>

            <a href="{{ route('pembayaran.index') }}" class="menu-card">
                <div class="menu-icon" style="background: linear-gradient(135deg, #fef9e7 0%, #f9e79f 100%);">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <strong>Pembayaran SPP</strong>
                <p>Input & kelola pembayaran</p>
            </a>

            <a href="{{ route('kelas.index') }}" class="menu-card">
                <div class="menu-icon" style="background: linear-gradient(135deg, #abebc6 0%, #52be80 100%);">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <strong>Data Kelas</strong>
                <p>Manajemen data kelas</p>
            </a>

            <a href="{{ route('spp.index') }}" class="menu-card">
                <div class="menu-icon" style="background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);">
                    <i class="fas fa-coins"></i>
                </div>
                <strong>Kelola SPP</strong>
                <p>Atur nominal SPP</p>
            </a>
        </div>
    </div>
</div>

<style>
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .menu-card {
        padding: 25px 20px;
        background: white;
        border: 2px solid #d5f4e6;
        border-radius: 12px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
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
        background: linear-gradient(90deg, #52be80 0%, #f9e79f 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .menu-card:hover::before {
        transform: scaleX(1);
    }

    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(82, 190, 128, 0.2);
        border-color: #52be80;
    }

    .menu-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
        transition: all 0.3s ease;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(82, 190, 128, 0.3);
    }

    .menu-card strong {
        display: block;
        color: #27ae60;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .menu-card p {
        color: #7f8c8d;
        font-size: 13px;
        margin: 0;
    }

    /* Stat Cards Update */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(82, 190, 128, 0.1);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(82, 190, 128, 0.15);
        border-color: #d5f4e6;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #abebc6 0%, #52be80 100%);
        box-shadow: 0 4px 15px rgba(82, 190, 128, 0.3);
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
        box-shadow: 0 4px 15px rgba(249, 231, 159, 0.3);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        box-shadow: 0 4px 15px rgba(82, 190, 128, 0.4);
    }

    .stat-icon.purple {
        background: linear-gradient(135deg, #f4d03f 0%, #f39c12 100%);
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
    }

    .stat-info h3 {
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .stat-info p {
        font-size: 28px;
        font-weight: bold;
        color: #27ae60;
        margin: 0;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(82, 190, 128, 0.1);
        overflow: hidden;
        border: 2px solid #d5f4e6;
    }

    .card-body {
        padding: 30px;
    }
</style>
@endsection
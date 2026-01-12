@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            👥
        </div>
        <div class="stat-info">
            <h3>Total Siswa</h3>
            <p>{{ $totalSiswa }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            🏫
        </div>
        <div class="stat-info">
            <h3>Total Kelas</h3>
            <p>{{ $totalKelas }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            💰
        </div>
        <div class="stat-info">
            <h3>Total Pembayaran</h3>
            <p>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            📅
        </div>
        <div class="stat-info">
            <h3>Bulan Ini</h3>
            <p>Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h2 style="margin-bottom: 20px;">📊 Ringkasan Sistem</h2>
        <p style="color: #7f8c8d; margin-bottom: 20px;">
            Selamat datang di Sistem Manajemen Pembayaran SPP. Gunakan menu di sebelah kiri untuk navigasi.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="{{ route('siswa.index') }}" style="text-decoration: none;">
                <div style="padding: 20px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                    <div style="font-size: 32px; margin-bottom: 10px;">👥</div>
                    <strong style="color: #2c3e50;">Kelola Siswa</strong>
                </div>
            </a>

            <a href="{{ route('pembayaran.index') }}" style="text-decoration: none;">
                <div style="padding: 20px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                    <div style="font-size: 32px; margin-bottom: 10px;">📝</div>
                    <strong style="color: #2c3e50;">Pembayaran SPP</strong>
                </div>
            </a>

            <a href="{{ route('kelas.index') }}" style="text-decoration: none;">
                <div style="padding: 20px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                    <div style="font-size: 32px; margin-bottom: 10px;">🏫</div>
                    <strong style="color: #2c3e50;">Data Kelas</strong>
                </div>
            </a>

            <a href="{{ route('spp.index') }}" style="text-decoration: none;">
                <div style="padding: 20px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                    <div style="font-size: 32px; margin-bottom: 10px;">💵</div>
                    <strong style="color: #2c3e50;">Kelola SPP</strong>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
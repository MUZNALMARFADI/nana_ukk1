@extends('layouts.app')

@section('title', 'Generate Laporan')

@section('content')
<div class="content-header">
    <h1>📊 Generate Laporan</h1>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <!-- Laporan Pembayaran -->
    <div class="card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 64px; margin-bottom: 20px;">💰</div>
            <h2 style="margin-bottom: 15px;">Laporan Pembayaran</h2>
            <p style="color: #7f8c8d; margin-bottom: 25px;">
                Laporan detail pembayaran SPP berdasarkan periode tertentu
            </p>
            <a href="{{ route('laporan.pembayaran') }}" class="btn-primary">
                📄 Buat Laporan
            </a>
        </div>
    </div>

    <!-- Laporan Tunggakan -->
    <div class="card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 64px; margin-bottom: 20px;">⚠️</div>
            <h2 style="margin-bottom: 15px;">Laporan Tunggakan</h2>
            <p style="color: #7f8c8d; margin-bottom: 25px;">
                Daftar siswa yang memiliki tunggakan pembayaran SPP
            </p>
            <a href="{{ route('laporan.tunggakan') }}" class="btn-primary">
                📄 Buat Laporan
            </a>
        </div>
    </div>

    <!-- Laporan Per Kelas -->
    <div class="card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 64px; margin-bottom: 20px;">🏫</div>
            <h2 style="margin-bottom: 15px;">Laporan Per Kelas</h2>
            <p style="color: #7f8c8d; margin-bottom: 25px;">
                Rekap pembayaran SPP berdasarkan kelas
            </p>
            <a href="{{ route('laporan.per-kelas') }}" class="btn-primary">
                📄 Buat Laporan
            </a>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 30px;">
    <div class="card-body">
        <h3 style="margin-bottom: 15px;">📝 Panduan Generate Laporan</h3>
        <ul style="color: #7f8c8d; line-height: 2;">
            <li><strong>Laporan Pembayaran:</strong> Menampilkan semua transaksi pembayaran dengan filter bulan, tahun, dan kelas</li>
            <li><strong>Laporan Tunggakan:</strong> Menampilkan siswa yang belum membayar SPP lengkap dengan jumlah tunggakan</li>
            <li><strong>Laporan Per Kelas:</strong> Menampilkan statistik pembayaran berdasarkan kelas</li>
            <li>Semua laporan dapat di-download dalam format PDF</li>
        </ul>
    </div>
</div>
@endsection
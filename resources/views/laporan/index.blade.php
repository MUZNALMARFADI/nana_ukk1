@extends('layouts.app')

@section('title', 'Generate Laporan')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1><i class="fas fa-print"></i> Pusat Laporan</h1>
        <p class="text-muted">Pilih jenis laporan untuk diunduh dalam format Excel</p>
    </div>
</div>

<div class="report-list-container">
    
    <div class="report-list-item">
        <div class="item-icon-box bg-green">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="item-info">
            <h3>Laporan Pembayaran</h3>
            <p>Rekap detail seluruh transaksi masuk. Bisa difilter per bulan, tahun, dan kelas.</p>
        </div>
        <div class="item-action">
            <a href="{{ route('laporan.pembayaran') }}" class="btn-open">
                Buka <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <div class="report-list-item">
        <div class="item-icon-box bg-red">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="item-info">
            <h3>Laporan Tunggakan</h3>
            <p>Daftar siswa yang masih memiliki kewajiban pembayaran (Tagihan SPP).</p>
        </div>
        <div class="item-action">
            <a href="{{ route('laporan.tunggakan') }}" class="btn-open">
                Buka <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <div class="report-list-item">
        <div class="item-icon-box bg-blue">
            <i class="fas fa-school"></i>
        </div>
        <div class="item-info">
            <h3>Laporan Per Kelas</h3>
            <p>Statistik perbandingan siswa lunas dan menunggak di setiap kelas.</p>
        </div>
        <div class="item-action">
            <a href="{{ route('laporan.per-kelas') }}" class="btn-open">
                Buka <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="guide-box">
    <h4><i class="fas fa-info-circle"></i> Info Ekspor Excel</h4>
    <p>Setelah menekan tombol <strong>Buka</strong>, Anda akan diarahkan ke halaman pratinjau data. Gunakan tombol <strong>Export Excel</strong> di halaman tersebut untuk mengunduh file.</p>
</div>

<style>
/* Container List */
.report-list-container {
    display: flex;
    flex-direction: column; /* Membuat kotak berderet ke bawah */
    gap: 15px;
    margin-bottom: 30px;
}

/* Kotak List Item */
.report-list-item {
    background: white;
    display: flex;
    align-items: center;
    padding: 20px;
    border-radius: 15px;
    border: 1px solid #edf2f7;
    transition: all 0.3s ease;
}

.report-list-item:hover {
    transform: translateX(10px); /* Efek geser sedikit ke kanan saat dihover */
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border-color: #cbd5e1;
}

/* Icon Box */
.item-icon-box {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-right: 20px;
    flex-shrink: 0;
}
.bg-green { background: #e8f8f0; color: #27ae60; }
.bg-red { background: #fdedec; color: #e74c3c; }
.bg-blue { background: #ebf5fb; color: #3498db; }

/* Info Text */
.item-info {
    flex-grow: 1;
}
.item-info h3 {
    margin: 0 0 5px 0;
    font-size: 1.1rem;
    color: #2c3e50;
}
.item-info p {
    margin: 0;
    font-size: 0.9rem;
    color: #7f8c8d;
}

/* Button Action */
.item-action {
    margin-left: 20px;
}
.btn-open {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    color: #475569;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}
.btn-open:hover {
    background: #1e293b;
    color: white;
}

/* Guide Box */
.guide-box {
    background: #fffbeb;
    border-left: 4px solid #f59e0b;
    padding: 20px;
    border-radius: 8px;
    color: #92400e;
}
.guide-box h4 { margin: 0 0 10px 0; }
.guide-box p { margin: 0; font-size: 0.9rem; line-height: 1.5; }

/* Responsive */
@media (max-width: 600px) {
    .report-list-item {
        flex-direction: column;
        text-align: center;
    }
    .item-icon-box { margin-right: 0; margin-bottom: 15px; }
    .item-action { margin-left: 0; margin-top: 15px; width: 100%; }
    .btn-open { justify-content: center; }
}
</style>
@endsection
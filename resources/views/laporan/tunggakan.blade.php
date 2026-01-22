@extends('layouts.app')

@section('title', 'Laporan Tunggakan')

@section('content')
<div class="content-header no-print">
    <div class="header-left">
        <h1><i class="fas fa-exclamation-triangle"></i> Laporan Tunggakan SPP</h1>
        <p class="subtitle-text">Data siswa yang belum melunasi pembayaran SPP tahun {{ $tahun }}</p>
    </div>
    <a href="{{ route('laporan.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Statistics Cards -->
<div class="statistics-grid">
    <div class="stat-box red">
        <div class="stat-icon-wrapper">
            <i class="fas fa-user-times"></i>
        </div>
        <div class="stat-info">
            <span class="stat-title">Siswa Menunggak</span>
            <h2 class="stat-value">{{ count($dataTunggakan) }}</h2>
            <span class="stat-unit">Siswa</span>
        </div>
        <div class="stat-decoration"></div>
    </div>

    <div class="stat-box orange">
        <div class="stat-icon-wrapper">
            <i class="fas fa-calendar-times"></i>
        </div>
        <div class="stat-info">
            <span class="stat-title">Total Bulan Menunggak</span>
            <h2 class="stat-value">
                @php 
                    $totalBulan = 0;
                    foreach($dataTunggakan as $d) { 
                        $totalBulan += count($d['bulan_belum_bayar']); 
                    }
                @endphp
                {{ $totalBulan }}
            </h2>
            <span class="stat-unit">Bulan</span>
        </div>
        <div class="stat-decoration"></div>
    </div>

    <div class="stat-box dark-red">
        <div class="stat-icon-wrapper">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <span class="stat-title">Total Nilai Tunggakan</span>
            <h2 class="stat-value-money">
                Rp {{ number_format(array_sum(array_column($dataTunggakan, 'jumlah_tunggakan')), 0, ',', '.') }}
            </h2>
        </div>
        <div class="stat-decoration"></div>
    </div>
</div>

<!-- Filter Section -->
<div class="card filter-section no-print">
    <div class="card-header">
        <h3><i class="fas fa-filter"></i> Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('laporan.tunggakan') }}" method="GET">
            <div class="filter-layout">
                <div class="filter-field">
                    <label for="tahun">
                        <i class="fas fa-calendar-alt"></i> Tahun Ajaran
                    </label>
                    <select name="tahun" id="tahun" class="form-control">
                        @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ (request('tahun', date('Y')) == $y) ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endfor
                    </select>
                </div>

                <div class="filter-field">
                    <label for="kelas">
                        <i class="fas fa-school"></i> Filter Kelas
                    </label>
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-field">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-apply">
                        <i class="fas fa-search"></i> Tampilkan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Section -->
<div class="card table-section">
    <div class="table-header">
        <div class="header-content">
            <h3><i class="fas fa-clipboard-list"></i> Daftar Siswa Menunggak</h3>
            <span class="data-info">
                <i class="fas fa-database"></i>
                {{ count($dataTunggakan) }} Data ditemukan
            </span>
        </div>
        <div class="header-buttons no-print">
            <form action="{{ route('laporan.tunggakan') }}" method="GET" style="display: flex; gap: 10px;">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                <button type="submit" name="export" value="1" class="btn-export-excel">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <button onclick="window.print()" type="button" class="btn-print">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table class="report-table">
            <thead>
                <tr>
                    <th width="60">
                        <i class="fas fa-hashtag"></i> No
                    </th>
                    <th>
                        <i class="fas fa-user-graduate"></i> Nama Siswa
                    </th>
                    <th width="150">
                        <i class="fas fa-school"></i> Kelas
                    </th>
                    <th>
                        <i class="fas fa-calendar-times"></i> Bulan Menunggak
                    </th>
                    <th width="120" class="text-center">
                        <i class="fas fa-hourglass-half"></i> Durasi
                    </th>
                    <th width="180" class="text-right">
                        <i class="fas fa-money-bill-wave"></i> Total Tunggakan
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataTunggakan as $index => $item)
                <tr>
                    <td class="text-center">
                        <span class="row-num">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <div class="student-detail">
                            <strong class="student-name">{{ $item['siswa']->nama }}</strong>
                            <span class="student-nisn">
                                <i class="fas fa-id-card"></i> NISN: {{ $item['siswa']->nisn }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="badge-class">{{ $item['siswa']->kelas->nama_kelas ?? '-' }}</span>
                    </td>
                    <td>
                        <div class="month-container">
                            @foreach($item['bulan_belum_bayar'] as $bulan)
                            <span class="month-badge">{{ $bulan }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="duration-badge">
                            <i class="fas fa-calendar"></i>
                            {{ count($item['bulan_belum_bayar']) }} Bulan
                        </span>
                    </td>
                    <td class="text-right">
                        <div class="amount-danger">
                            Rp {{ number_format($item['jumlah_tunggakan'], 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-result">
                            <i class="fas fa-check-circle"></i>
                            <h4>Luar Biasa!</h4>
                            <p>Tidak ada tunggakan pembayaran SPP untuk filter yang dipilih.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($dataTunggakan) > 0)
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">
                        <i class="fas fa-calculator"></i> TOTAL TUNGGAKAN KESELURUHAN:
                    </th>
                    <th class="text-center">
                        <span class="total-months">{{ $totalBulan }} Bulan</span>
                    </th>
                    <th class="text-right">
                        <div class="grand-total-danger">
                            Rp {{ number_format(array_sum(array_column($dataTunggakan, 'jumlah_tunggakan')), 0, ',', '.') }}
                        </div>
                    </th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<style>
/* Typography */
.subtitle-text {
    color: #64748b;
    font-size: 14px;
    margin-top: 5px;
    font-weight: 400;
}

/* Statistics Grid - FIXED: 3 columns always */
.statistics-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-box {
    background: white;
    border-radius: 14px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 18px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    border: 1px solid #f1f5f9;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.stat-box.red .stat-icon-wrapper { 
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.stat-box.orange .stat-icon-wrapper { 
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.stat-box.dark-red .stat-icon-wrapper { 
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.stat-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 26px;
    flex-shrink: 0;
}

.stat-info {
    flex: 1;
}

.stat-title {
    display: block;
    font-size: 13px;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 36px;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1;
}

.stat-value-money {
    font-size: 22px;
    font-weight: 800;
    color: #dc2626;
    margin: 0;
    line-height: 1.2;
}

.stat-unit {
    font-size: 13px;
    color: #94a3b8;
    font-weight: 500;
}

.stat-decoration {
    position: absolute;
    right: -20px;
    top: -20px;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

/* Filter Section */
.filter-section {
    margin-bottom: 25px;
}

.filter-section .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 16px 20px;
    border-bottom: 2px solid #e2e8f0;
}

.filter-section .card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
}

.filter-layout {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 20px;
}

.filter-field label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}

.filter-field label i {
    margin-right: 6px;
    color: #64748b;
}

.btn-apply {
    width: 100%;
    min-width: 200px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(30, 41, 59, 0.3);
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.table-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 20px;
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h3 {
    margin: 0 0 6px 0;
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
}

.data-info {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}

.header-buttons {
    display: flex;
    gap: 10px;
}

.btn-export-excel {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-export-excel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
}

.btn-print {
    background: linear-gradient(135deg, #475569 0%, #334155 100%);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-print:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(71, 85, 105, 0.3);
}

/* Table Styling */
.table-container {
    overflow-x: auto;
}

.report-table {
    width: 100%;
    border-collapse: collapse;
}

.report-table thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    padding: 16px 14px;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}

.report-table thead th i {
    margin-right: 6px;
    color: #64748b;
}

.report-table tbody td {
    padding: 16px 14px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.report-table tbody tr {
    transition: all 0.2s ease;
}

.report-table tbody tr:hover {
    background: #f8fafc;
}

.report-table tfoot th {
    background: #fee2e2;
    padding: 18px 14px;
    border-top: 3px solid #dc2626;
    font-size: 14px;
    font-weight: 700;
    color: #991b1b;
}

/* Table Elements */
.row-num {
    display: inline-block;
    width: 32px;
    height: 32px;
    background: #f1f5f9;
    border-radius: 8px;
    line-height: 32px;
    text-align: center;
    font-weight: 700;
    color: #475569;
}

.student-detail {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.student-name {
    color: #1e293b;
    font-size: 14px;
    font-weight: 700;
}

.student-nisn {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 5px;
}

.badge-class {
    display: inline-block;
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: #4338ca;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.month-container {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    max-width: 350px;
}

.month-badge {
    background: #fee2e2;
    color: #991b1b;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    border: 1px solid #fecaca;
}

.duration-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
    color: #9a3412;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}

.amount-danger {
    color: #dc2626;
    font-size: 16px;
    font-weight: 800;
}

.total-months {
    color: #ea580c;
    font-weight: 700;
}

.grand-total-danger {
    color: #b91c1c;
    font-size: 18px;
    font-weight: 900;
}

/* Empty State */
.empty-result {
    text-align: center;
    padding: 60px 20px;
}

.empty-result i {
    font-size: 64px;
    color: #16a34a;
    margin-bottom: 16px;
}

.empty-result h4 {
    color: #16a34a;
    font-size: 20px;
    margin: 0 0 8px 0;
    font-weight: 700;
}

.empty-result p {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

/* Print Styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    .statistics-grid,
    .table-section {
        box-shadow: none !important;
        border: 1px solid #000;
    }
    
    .report-table th,
    .report-table td {
        border: 1px solid #000 !important;
    }
    
    body {
        background: white;
    }
}

/* Responsive */
@media (max-width: 992px) {
    .statistics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-layout {
        grid-template-columns: 1fr;
    }
    
    .btn-apply {
        min-width: auto;
    }
}

@media (max-width: 768px) {
    .statistics-grid {
        grid-template-columns: 1fr;
    }
    
    .table-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .header-buttons {
        flex-direction: column;
    }
    
    .btn-export-excel,
    .btn-print {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
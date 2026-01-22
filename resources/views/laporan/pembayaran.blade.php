@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1><i class="fas fa-file-invoice-dollar"></i> Laporan Pembayaran</h1>
        <p class="subtitle-text">Pantau dan kelola data transaksi pembayaran SPP</p>
    </div>
    <a href="{{ route('laporan.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Stats Cards - 2x2 Layout -->
<div class="stats-container-2x2">
    <div class="stat-card green">
        <div class="stat-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-details">
            <span class="stat-label">Total Pendapatan</span>
            <h2 class="stat-number">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h2>
        </div>
    </div>
    
    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="stat-details">
            <span class="stat-label">Total Transaksi</span>
            <h2 class="stat-number">{{ $pembayaran->count() }}</h2>
            <span class="stat-sublabel">Transaksi</span>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-details">
            <span class="stat-label">Bulan Aktif</span>
            <h2 class="stat-number">{{ $pembayaran->unique('bulan_dibayar')->count() }}</h2>
            <span class="stat-sublabel">Bulan</span>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-details">
            <span class="stat-label">Siswa Terlibat</span>
            <h2 class="stat-number">{{ $pembayaran->unique('nisn')->count() }}</h2>
            <span class="stat-sublabel">Siswa</span>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="card filter-card">
    <div class="card-header">
        <h3><i class="fas fa-sliders-h"></i> Filter Data Laporan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('laporan.pembayaran') }}" method="GET">
            <div class="filter-row">
                <div class="filter-item">
                    <label for="bulan">
                        <i class="fas fa-calendar-alt"></i> Bulan
                    </label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">-- Semua Bulan --</option>
                        @foreach($bulan as $b)
                        <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label for="tahun">
                        <i class="fas fa-calendar-check"></i> Tahun
                    </label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">-- Semua Tahun --</option>
                        @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="filter-item">
                    <label for="kelas">
                        <i class="fas fa-school"></i> Kelas
                    </label>
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Active Filter Info -->
@if(request('bulan') || request('tahun') || request('kelas'))
<div class="active-filter-box">
    <div class="filter-info">
        <i class="fas fa-info-circle"></i>
        <span>
            Filter Aktif: 
            <strong>{{ request('bulan') ?? 'Semua Bulan' }}</strong> | 
            <strong>{{ request('tahun') ?? 'Semua Tahun' }}</strong> | 
            <strong>{{ request('kelas') ? $kelas->firstWhere('id_kelas', request('kelas'))->nama_kelas : 'Semua Kelas' }}</strong>
        </span>
    </div>
    <a href="{{ route('laporan.pembayaran') }}" class="btn-reset-filter">
        <i class="fas fa-times-circle"></i> Reset Filter
    </a>
</div>
@endif

<!-- Table Card -->
<div class="card table-card">
    <div class="card-header-actions">
        <div class="header-title">
            <h3><i class="fas fa-table"></i> Rincian Transaksi Pembayaran</h3>
            <span class="record-count">{{ $pembayaran->count() }} Data ditemukan</span>
        </div>
        <form action="{{ route('laporan.pembayaran') }}" method="GET">
            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            <input type="hidden" name="kelas" value="{{ request('kelas') }}">
            <button type="submit" name="export" value="1" class="btn-export">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </form>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th width="120"><i class="fas fa-id-card"></i> NISN</th>
                    <th><i class="fas fa-user-graduate"></i> Nama Siswa</th>
                    <th width="150"><i class="fas fa-school"></i> Kelas</th>
                    <th width="150"><i class="fas fa-calendar"></i> Bulan/Tahun</th>
                    <th width="150"><i class="fas fa-money-bill-wave"></i> Nominal</th>
                    <th width="120"><i class="fas fa-calendar-day"></i> Tgl Bayar</th>
                    <th width="130"><i class="fas fa-user-tie"></i> Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayaran as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <span class="badge-nisn">{{ $item->nisn }}</span>
                    </td>
                    <td>
                        <div class="student-info">
                            <strong>{{ $item->siswa->nama ?? '-' }}</strong>
                        </div>
                    </td>
                    <td>
                        <span class="badge-kelas">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</span>
                    </td>
                    <td class="text-center">
                        <div class="month-year">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $item->bulan_dibayar }} {{ $item->tahun_dibayar }}
                        </div>
                    </td>
                    <td>
                        <div class="amount-display">
                            <strong>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="date-badge">
                            <i class="fas fa-calendar-check"></i>
                            {{ $item->tgl_bayar->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>
                        <span class="petugas-name">
                            <i class="fas fa-user"></i>
                            {{ $item->petugas->nama_petugas ?? '-' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-folder-open"></i>
                            <h4>Tidak Ada Data</h4>
                            <p>Data pembayaran tidak ditemukan. Silakan sesuaikan filter pencarian Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if($pembayaran->count() > 0)
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">
                        <i class="fas fa-calculator"></i> TOTAL KESELURUHAN:
                    </th>
                    <th>
                        <div class="total-amount">
                            Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                        </div>
                    </th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<style>
/* Typography & Utilities */
.subtitle-text {
    color: #64748b;
    font-size: 14px;
    margin-top: 5px;
    font-weight: 400;
}

/* Stats Container - 2x2 Grid Layout */
.stats-container-2x2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 18px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid #f1f5f9;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.stat-card.green .stat-icon { background: linear-gradient(135deg, #d5f4e6 0%, #c8f0dd 100%); color: #16a34a; }
.stat-card.blue .stat-icon { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #2563eb; }
.stat-card.purple .stat-icon { background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%); color: #9333ea; }
.stat-card.orange .stat-icon { background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%); color: #ea580c; }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.stat-details {
    flex: 1;
}

.stat-label {
    display: block;
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 5px;
}

.stat-number {
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1.2;
}

.stat-sublabel {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 500;
}

/* Filter Card */
.filter-card {
    margin-bottom: 25px;
}

.filter-card .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 16px 20px;
    border-bottom: 2px solid #e2e8f0;
}

.filter-card .card-header h3 {
    margin: 0;
    color: #1e293b;
    font-size: 16px;
    font-weight: 700;
}

.filter-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.filter-item label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}

.filter-item label i {
    margin-right: 5px;
    color: #64748b;
}

.btn-filter {
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
}

/* Active Filter Box */
.active-filter-box {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    border-left: 4px solid #16a34a;
    padding: 16px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 6px rgba(22, 163, 74, 0.1);
}

.filter-info {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #166534;
    font-size: 14px;
}

.filter-info i {
    font-size: 18px;
}

.btn-reset-filter {
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset-filter:hover {
    background: #b91c1c;
    transform: scale(1.05);
}

/* Table Card */
.table-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.card-header-actions {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 20px;
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-title h3 {
    margin: 0;
    color: #1e293b;
    font-size: 17px;
    font-weight: 700;
}

.record-count {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-top: 4px;
}

.btn-export {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
}

/* Table Styling */
.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    padding: 16px 12px;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}

.data-table thead th i {
    margin-right: 5px;
    color: #64748b;
}

.data-table tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13px;
    color: #334155;
}

.data-table tbody tr {
    transition: all 0.2s ease;
}

.data-table tbody tr:hover {
    background: #f8fafc;
}

.data-table tfoot th {
    background: #f8fafc;
    padding: 16px 12px;
    border-top: 2px solid #e2e8f0;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
}

/* Table Elements */
.badge-nisn {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1e40af;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
}

.student-info strong {
    color: #1e293b;
    font-size: 13px;
}

.badge-kelas {
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: #4338ca;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.month-year {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    color: #475569;
    font-weight: 600;
}

.month-year i {
    color: #64748b;
}

.amount-display strong {
    color: #16a34a;
    font-size: 14px;
    font-weight: 700;
}

.date-badge {
    background: #f1f5f9;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.petugas-name {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 5px;
}

.total-amount {
    color: #16a34a;
    font-size: 16px;
    font-weight: 800;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 64px;
    color: #cbd5e1;
    margin-bottom: 16px;
}

.empty-state h4 {
    color: #64748b;
    font-size: 18px;
    margin: 0 0 8px 0;
}

.empty-state p {
    color: #94a3b8;
    font-size: 14px;
    margin: 0;
}

/* Responsive */
@media (max-width: 992px) {
    .filter-row {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .stats-container-2x2 {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }
    
    .filter-row {
        grid-template-columns: 1fr;
    }
    
    .card-header-actions {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .btn-export {
        width: 100%;
    }
}
</style>
@endsection
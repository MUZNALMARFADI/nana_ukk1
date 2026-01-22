@extends('layouts.app')

@section('title', 'Laporan Per Kelas')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1><i class="fas fa-school"></i> Laporan Per Kelas</h1>
        <p class="subtitle-text">Rekapitulasi status pembayaran SPP berdasarkan kelas tahun {{ $tahun }}</p>
    </div>
    <a href="{{ route('laporan.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Summary Stats - 2x2 Layout -->
<div class="summary-grid-2x2">
    <div class="summary-card blue">
        <div class="summary-icon">
            <i class="fas fa-door-open"></i>
        </div>
        <div class="summary-content">
            <span class="summary-label">Total Kelas</span>
            <h2 class="summary-value">{{ count($dataKelas) }}</h2>
            <span class="summary-unit">Kelas</span>
        </div>
        <div class="summary-decoration"></div>
    </div>

    <div class="summary-card purple">
        <div class="summary-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="summary-content">
            <span class="summary-label">Total Siswa</span>
            <h2 class="summary-value">{{ array_sum(array_column($dataKelas, 'total_siswa')) }}</h2>
            <span class="summary-unit">Siswa</span>
        </div>
        <div class="summary-decoration"></div>
    </div>

    <div class="summary-card green">
        <div class="summary-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="summary-content">
            <span class="summary-label">Sudah Bayar</span>
            <h2 class="summary-value">{{ array_sum(array_column($dataKelas, 'siswa_sudah_bayar')) }}</h2>
            <span class="summary-unit">Siswa</span>
        </div>
        <div class="summary-decoration"></div>
    </div>

    <div class="summary-card red">
        <div class="summary-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="summary-content">
            <span class="summary-label">Belum Bayar</span>
            <h2 class="summary-value">{{ array_sum(array_column($dataKelas, 'siswa_belum_bayar')) }}</h2>
            <span class="summary-unit">Siswa</span>
        </div>
        <div class="summary-decoration"></div>
    </div>
</div>

<!-- Filter Section -->
<div class="card filter-section">
    <div class="card-header">
        <h3><i class="fas fa-filter"></i> Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('laporan.per-kelas') }}" method="GET">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="tahun">
                        <i class="fas fa-calendar-alt"></i> Tahun Ajaran
                    </label>
                    <select name="tahun" id="tahun" class="form-control">
                        @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ (request('tahun', date('Y')) == $y) ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group">
                    <label for="kelas_id">
                        <i class="fas fa-school"></i> Filter Kelas
                    </label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($allKelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('kelas_id') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-apply-filter">
                        <i class="fas fa-sync-alt"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Section -->
<div class="card table-section">
    <div class="card-header-flex">
        <div class="header-info">
            <h3><i class="fas fa-table"></i> Tabel Rekapitulasi Per Kelas</h3>
            <span class="data-count">
                <i class="fas fa-database"></i>
                {{ count($dataKelas) }} Kelas ditemukan
            </span>
        </div>
        <div class="header-actions">
            <form action="{{ route('laporan.per-kelas') }}" method="GET" style="margin: 0;">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
                <button type="submit" name="export" value="1" class="btn-export-excel">
                    <i class="fas fa-file-excel"></i> Export Excel
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
                        <i class="fas fa-graduation-cap"></i> Informasi Kelas
                    </th>
                    <th class="text-center" width="100">
                        <i class="fas fa-users"></i> Siswa
                    </th>
                    <th class="text-right" width="180">
                        <i class="fas fa-money-bill-wave"></i> Total Dana
                    </th>
                    <th class="text-center" width="150">
                        <i class="fas fa-chart-pie"></i> Status
                    </th>
                    <th width="220">
                        <i class="fas fa-percentage"></i> Persentase
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataKelas as $index => $item)
                @php
                    $persentase = $item['total_siswa'] > 0 ? ($item['siswa_sudah_bayar'] / $item['total_siswa']) * 100 : 0;
                    $statusColor = $persentase >= 80 ? 'success' : ($persentase >= 50 ? 'warning' : 'danger');
                    $barColor = $persentase >= 80 ? '#16a34a' : ($persentase >= 50 ? '#f59e0b' : '#dc2626');
                @endphp
                <tr>
                    <td class="text-center">
                        <span class="row-number">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <div class="class-detail">
                            <h4>{{ $item['kelas']->nama_kelas }}</h4>
                            <span class="class-major">
                                <i class="fas fa-bookmark"></i>
                                {{ $item['kelas']->kompetensi_keahlian }}
                            </span>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge-students">{{ $item['total_siswa'] }}</span>
                    </td>
                    <td class="text-right">
                        <div class="amount-box">
                            <strong>Rp {{ number_format($item['total_pembayaran'], 0, ',', '.') }}</strong>
                        </div>
                    </td>
                    <td>
                        <div class="status-badges">
                            <span class="status-badge success">
                                <i class="fas fa-check-circle"></i>
                                {{ $item['siswa_sudah_bayar'] }} Lunas
                            </span>
                            <span class="status-badge danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $item['siswa_belum_bayar'] }} Belum
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="progress-box">
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar-track">
                                    <div class="progress-bar-fill {{ $statusColor }}" style="width: {{ $persentase }}%"></div>
                                </div>
                            </div>
                            <span class="progress-percentage {{ $statusColor }}">
                                {{ number_format($persentase, 1) }}%
                            </span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-result">
                            <i class="fas fa-inbox"></i>
                            <h4>Data Tidak Ditemukan</h4>
                            <p>Tidak ada data kelas yang tersedia untuk tahun ajaran ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($dataKelas) > 0)
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">
                        <i class="fas fa-calculator"></i> TOTAL KESELURUHAN
                    </th>
                    <th class="text-center">
                        <span class="total-badge">{{ array_sum(array_column($dataKelas, 'total_siswa')) }}</span>
                    </th>
                    <th class="text-right">
                        <div class="grand-total">
                            Rp {{ number_format(array_sum(array_column($dataKelas, 'total_pembayaran')), 0, ',', '.') }}
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
/* Typography */
.subtitle-text {
    color: #64748b;
    font-size: 14px;
    margin-top: 5px;
    font-weight: 400;
}

/* Summary Grid - 2x2 Layout */
.summary-grid-2x2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.summary-card {
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

.summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.summary-card.blue .summary-icon { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
.summary-card.purple .summary-icon { background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); }
.summary-card.green .summary-icon { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
.summary-card.red .summary-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }

.summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.summary-content {
    flex: 1;
}

.summary-label {
    display: block;
    font-size: 13px;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.summary-value {
    font-size: 32px;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1;
}

.summary-unit {
    font-size: 13px;
    color: #94a3b8;
    font-weight: 500;
}

.summary-decoration {
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

.filter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 20px;
}

.filter-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}

.filter-group label i {
    margin-right: 6px;
    color: #64748b;
}

.btn-apply-filter {
    width: 100%;
    min-width: 180px;
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

.btn-apply-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(30, 41, 59, 0.3);
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.card-header-flex {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 20px;
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info h3 {
    margin: 0 0 6px 0;
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
}

.data-count {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-export-excel {
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

.btn-export-excel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
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
    background: #f8fafc;
    padding: 18px 14px;
    border-top: 3px solid #e2e8f0;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
}

/* Table Elements */
.row-number {
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

.class-detail h4 {
    margin: 0 0 6px 0;
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
}

.class-major {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #64748b;
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 6px;
}

.badge-students {
    display: inline-block;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1e40af;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
}

.amount-box strong {
    color: #16a34a;
    font-size: 15px;
    font-weight: 700;
}

.status-badges {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.success {
    background: #dcfce7;
    color: #166534;
}

.status-badge.danger {
    background: #fee2e2;
    color: #991b1b;
}

.status-badge i {
    font-size: 10px;
}

/* Progress Bar */
.progress-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.progress-bar-wrapper {
    flex: 1;
}

.progress-bar-track {
    background: #f1f5f9;
    height: 10px;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s ease-in-out;
}

.progress-bar-fill.success { background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%); }
.progress-bar-fill.warning { background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%); }
.progress-bar-fill.danger { background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%); }

.progress-percentage {
    min-width: 50px;
    text-align: right;
    font-weight: 800;
    font-size: 13px;
}

.progress-percentage.success { color: #16a34a; }
.progress-percentage.warning { color: #d97706; }
.progress-percentage.danger { color: #dc2626; }

.total-badge {
    display: inline-block;
    background: #1e293b;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 700;
}

.grand-total {
    color: #16a34a;
    font-size: 18px;
    font-weight: 800;
}

/* Empty State */
.empty-result {
    text-align: center;
    padding: 60px 20px;
}

.empty-result i {
    font-size: 64px;
    color: #cbd5e1;
    margin-bottom: 16px;
}

.empty-result h4 {
    color: #64748b;
    font-size: 18px;
    margin: 0 0 8px 0;
}

.empty-result p {
    color: #94a3b8;
    font-size: 14px;
    margin: 0;
}

/* Responsive */
@media (max-width: 992px) {
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .btn-apply-filter {
        min-width: auto;
    }
}

@media (max-width: 768px) {
    .summary-grid-2x2 {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }
    
    .card-header-flex {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .btn-export-excel {
        width: 100%;
    }
}
</style>
@endsection
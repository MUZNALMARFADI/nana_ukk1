@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="content-header">
    <h1>Data Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Pembayaran
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<!-- Filter -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body">
        <form action="{{ route('pembayaran.index') }}" method="GET" class="filter-form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="search">Cari Siswa</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Nama atau NISN">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-- Semua Bulan --</option>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln)
                            <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">-- Semua Tahun --</option>
                            @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn-primary" style="width: 100%; display: block;">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $item)
                    <tr>
                        <td>{{ ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + $index + 1 }}</td>
                        <td>{{ $item->tgl_bayar->format('d/m/Y') }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->siswa->nama ?? '-' }}</td>
                        <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->bulan_dibayar }}</td>
                        <td>{{ $item->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $item->petugas->nama_petugas ?? '-' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}" class="btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pembayaran.edit', $item->id_pembayaran) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($pembayaran->hasPages())
        <div class="pagination-wrapper">
            {{ $pembayaran->links() }}
        </div>
        @endif
    </div>
</div>

<style>
/* ===== FORCE SMALL PAGINATION ===== */
.pagination-wrapper {
    margin-top: 10px;
    display: flex;
    justify-content: center;
}

nav[role="navigation"] {
    display: flex !important;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    font-size: 12px;
}

/* angka & tombol */
nav[role="navigation"] a,
nav[role="navigation"] span {
    padding: 4px 8px !important;
    font-size: 12px !important;
    line-height: 1 !important;
    min-height: unset !important;
    min-width: unset !important;
}

/* ikon panah <<< >>> */
nav[role="navigation"] svg {
    width: 12px !important;
    height: 12px !important;
}

/* active page */
nav[role="navigation"] .bg-indigo-600,
nav[role="navigation"] .bg-gray-200 {
    background: #52be80 !important;
    color: white !important;
    border-radius: 5px;
}

/* hover */
nav[role="navigation"] a:hover {
    background: #d5f4e6 !important;
}

/* hilangkan teks "Showing 1 to 10 of x results" */
nav[role="navigation"] p {
    display: none !important;
}
</style>

@endsection
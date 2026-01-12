@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="content-header">
    <h1>📝 Data Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.create') }}" class="btn-add">
        <i>➕</i> Tambah Pembayaran
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    <span>✅</span>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <span>❌</span>
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
                        <button type="submit" class="btn-primary" style="width: 100%; display: block;">🔍 Filter</button>
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
                                <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}" class="btn-view">👁️</a>
                                <a href="{{ route('pembayaran.edit', $item->id_pembayaran) }}" class="btn-edit">✏️</a>
                                <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️</button>
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
@endsection
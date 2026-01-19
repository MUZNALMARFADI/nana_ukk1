@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-eye"></i> Detail Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">
            <i class="fas fa-receipt"></i> Bukti Pembayaran
        </h3>
        
        <table class="detail-table">
            <tr>
                <th width="200"><i class="fas fa-hashtag"></i> No. Pembayaran</th>
                <td>{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-calendar"></i> Tanggal Bayar</th>
                <td>{{ $pembayaran->tgl_bayar->format('d F Y') }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-id-card"></i> NISN</th>
                <td>{{ $pembayaran->nisn }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-user"></i> Nama Siswa</th>
                <td>{{ $pembayaran->siswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-door-open"></i> Kelas</th>
                <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-calendar-alt"></i> Bulan Dibayar</th>
                <td>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-file-invoice-dollar"></i> Tahun SPP</th>
                <td>{{ $pembayaran->spp->tahun ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-money-bill-wave"></i> Jumlah Bayar</th>
                <td><strong style="font-size: 18px; color: #27ae60;">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th><i class="fas fa-user-tie"></i> Petugas</th>
                <td>{{ $pembayaran->petugas->nama_petugas ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-clock"></i> Waktu Input</th>
                <td>{{ $pembayaran->created_at->format('d F Y H:i') }}</td>
            </tr>
        </table>

        <div class="form-actions">
            <a href="{{ route('pembayaran.edit', $pembayaran->id_pembayaran) }}" class="btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <button onclick="window.print()" class="btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>
            <form action="{{ route('pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@media print {
    .content-header, .form-actions, .sidebar, .btn-back {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
    
    body {
        background: white !important;
    }
}
</style>
@endsection
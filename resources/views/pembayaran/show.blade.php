@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="content-header">
    <h1>👁️ Detail Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">🧾 Bukti Pembayaran</h3>
        
        <table class="detail-table">
            <tr>
                <th width="200">No. Pembayaran</th>
                <td>{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <th>Tanggal Bayar</th>
                <td>{{ $pembayaran->tgl_bayar->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>NISN</th>
                <td>{{ $pembayaran->nisn }}</td>
            </tr>
            <tr>
                <th>Nama Siswa</th>
                <td>{{ $pembayaran->siswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <th>Bulan Dibayar</th>
                <td>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</td>
            </tr>
            <tr>
                <th>Tahun SPP</th>
                <td>{{ $pembayaran->spp->tahun ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah Bayar</th>
                <td><strong style="font-size: 18px; color: #27ae60;">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th>Petugas</th>
                <td>{{ $pembayaran->petugas->nama_petugas ?? '-' }}</td>
            </tr>
            <tr>
                <th>Waktu Input</th>
                <td>{{ $pembayaran->created_at->format('d F Y H:i') }}</td>
            </tr>
        </table>

        <div class="form-actions">
            <a href="{{ route('pembayaran.edit', $pembayaran->id_pembayaran) }}" class="btn-primary">✏️ Edit</a>
            <button onclick="window.print()" class="btn-success">🖨️ Cetak</button>
            <form action="{{ route('pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">🗑️ Hapus</button>
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
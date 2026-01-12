@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="content-header">
    <h1>👁️ Detail Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">📋 Informasi Siswa</h3>
        <table class="detail-table">
            <tr>
                <th width="200">NISN</th>
                <td>{{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <th>NIS</th>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kompetensi Keahlian</th>
                <td>{{ $siswa->kelas->kompetensi_keahlian ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>{{ $siswa->no_telp }}</td>
            </tr>
            <tr>
                <th>SPP</th>
                <td>{{ $siswa->spp->tahun ?? '-' }} - Rp {{ number_format($siswa->spp->nominal ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">💰 History Pembayaran</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah Bayar</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa->pembayaran as $index => $bayar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bayar->tgl_bayar->format('d M Y') }}</td>
                    <td>{{ $bayar->bulan_dibayar }}</td>
                    <td>{{ $bayar->tahun_dibayar }}</td>
                    <td>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ $bayar->petugas->nama_petugas ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="form-actions">
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn-primary">✏️ Edit</a>
            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">🗑️ Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
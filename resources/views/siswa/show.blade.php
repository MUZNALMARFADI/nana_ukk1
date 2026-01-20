@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-eye"></i> Detail Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">
            <i class="fas fa-clipboard-list"></i> Informasi Siswa
        </h3>
        <table class="detail-table">
            <tr>
                <th width="200"><i class="fas fa-id-card"></i> NISN</th>
                <td>{{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-id-badge"></i> NIS</th>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-user"></i> Nama Lengkap</th>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-door-open"></i> Kelas</th>
                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-graduation-cap"></i> Kompetensi Keahlian</th>
                <td>{{ $siswa->kelas->kompetensi_keahlian ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                <td>{{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-phone"></i> No. Telepon</th>
                <td>{{ $siswa->no_telp }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-money-bill-wave"></i> SPP</th>
                <td>{{ $siswa->spp->tahun ?? '-' }} - Rp {{ number_format($siswa->spp->nominal ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">
            <i class="fas fa-history"></i> History Pembayaran
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th><i class="fas fa-calendar"></i> Tanggal Bayar</th>
                    <th><i class="fas fa-calendar-alt"></i> Bulan</th>
                    <th><i class="fas fa-calendar-check"></i> Tahun</th>
                    <th><i class="fas fa-money-bill"></i> Jumlah Bayar</th>
                    <th><i class="fas fa-user-tie"></i> Petugas</th>
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
                    <td colspan="6" class="text-center">
                        <i class="fas fa-inbox"></i> Belum ada pembayaran
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if(session('petugas')->level == 'admin')
        <div class="form-actions">
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
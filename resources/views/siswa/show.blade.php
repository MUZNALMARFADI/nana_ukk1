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
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn-warning">
                <i class="fas fa-edit"></i> Edit Data
            </a>
            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-soft">
                    <i class="fas fa-trash-alt"></i> Hapus Data
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<style>
/* Button Warning (Kuning) - untuk Edit */
.btn-warning {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #f9e79f 0%, #f4d03f 100%);
    color: #7d6608;
    text-decoration: none;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(249, 231, 159, 0.35);
}

.btn-warning:hover {
    background: linear-gradient(135deg, #f4d03f 0%, #f1c40f 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(249, 231, 159, 0.45);
    color: #6c5a05;
}

.btn-warning:active {
    transform: translateY(0);
}

/* Button Danger Soft (Merah Lembut) - untuk Hapus */
.btn-danger-soft {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #fadbd8 0%, #f5b7b1 100%);
    color: #922b21;
    text-decoration: none;
    border-radius: 8px;
    border: 2px solid #f5b7b1;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-danger-soft:hover {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    border-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.35);
}

.btn-danger-soft:active {
    transform: translateY(0);
}
</style>

<script>
function confirmDelete(event) {
    event.preventDefault();
    
    if (confirm('⚠️ Yakin ingin menghapus data siswa ini?\n\nData yang terhapus tidak dapat dikembalikan!')) {
        event.target.submit();
    }
    
    return false;
}
</script>
@endsection
@extends('layouts.app')

@section('title', 'Detail Petugas')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-eye"></i> Detail Data Petugas</h1>
    <a href="{{ route('petugas.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">
            <i class="fas fa-user-tie"></i> Informasi Petugas
        </h3>
        
        <table class="detail-table">
            <tr>
                <th width="200"><i class="fas fa-hashtag"></i> ID Petugas</th>
                <td>{{ $petuga->id_petugas }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-user"></i> Username</th>
                <td>{{ $petuga->username }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-id-card"></i> Nama Petugas</th>
                <td>{{ $petuga->nama_petugas }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-shield-alt"></i> Level</th>
                <td>
                    <span class="badge badge-{{ $petuga->level == 'admin' ? 'primary' : 'success' }}">
                        <i class="fas fa-{{ $petuga->level == 'admin' ? 'crown' : 'user-check' }}"></i>
                        {{ strtoupper($petuga->level) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th><i class="fas fa-clock"></i> Dibuat pada</th>
                <td>{{ $petuga->created_at->format('d F Y H:i') }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-sync-alt"></i> Terakhir diupdate</th>
                <td>{{ $petuga->updated_at->format('d F Y H:i') }}</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">
            <i class="fas fa-history"></i> Aktivitas Pembayaran
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th><i class="fas fa-calendar"></i> Tanggal</th>
                    <th><i class="fas fa-user-graduate"></i> Siswa</th>
                    <th><i class="fas fa-calendar-alt"></i> Bulan</th>
                    <th><i class="fas fa-money-bill-wave"></i> Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petuga->pembayaran()->latest()->limit(10)->get() as $index => $bayar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bayar->tgl_bayar->format('d/m/Y') }}</td>
                    <td>{{ $bayar->siswa->nama ?? '-' }}</td>
                    <td>{{ $bayar->bulan_dibayar }} {{ $bayar->tahun_dibayar }}</td>
                    <td>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <i class="fas fa-inbox"></i> Belum ada aktivitas pembayaran
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($petuga->pembayaran()->count() > 10)
        <div style="text-align: center; margin-top: 15px;">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> 
                Menampilkan 10 pembayaran terakhir dari {{ $petuga->pembayaran()->count() }} total pembayaran
            </small>
        </div>
        @endif

        @if(session('petugas')->level == 'admin')
        <div class="form-actions" style="margin-top: 30px;">
            <a href="{{ route('petugas.edit', $petuga->id_petugas) }}" class="btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if(session('petugas')->id_petugas != $petuga->id_petugas)
            <form action="{{ route('petugas.destroy', $petuga->id_petugas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </form>
            @endif
        </div>
        @endif
    </div>
</div>

<style>
/* Badge Styles */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
    text-transform: uppercase;
}

.badge-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.badge-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
}

.badge i {
    font-size: 12px;
}

.text-muted {
    color: #7f8c8d;
}
</style>
@endsection
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
            <a href="{{ route('petugas.edit', $petuga->id_petugas) }}" class="btn-edit">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if(session('petugas')->id_petugas != $petuga->id_petugas)
            <button type="button" class="btn-delete" onclick="confirmDelete('{{ $petuga->id_petugas }}')">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
            <form id="delete-form-{{ $petuga->id_petugas }}" action="{{ route('petugas.destroy', $petuga->id_petugas) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
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

/* Form Actions */
.form-actions {
    display: flex;
    gap: 15px;
    padding-top: 25px;
    border-top: 2px solid #e9ecef;
}

/* Button Edit - Hijau seperti sidebar */
.btn-edit {
    background: linear-gradient(135deg, #72c678 0%, #5fb365 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(114, 198, 120, 0.3);
}

.btn-edit:hover {
    background: linear-gradient(135deg, #5fb365 0%, #4da052 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(114, 198, 120, 0.4);
}

.btn-edit:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(114, 198, 120, 0.3);
}

.btn-edit i {
    font-size: 14px;
}

/* Button Delete - Merah */
.btn-delete {
    background: linear-gradient(135deg, #eb5757 0%, #f15e64 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(235, 87, 87, 0.3);
}

.btn-delete:hover {
    background: linear-gradient(135deg, #d32f2f 0%, #eb3941 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(235, 87, 87, 0.4);
}

.btn-delete:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(235, 87, 87, 0.3);
}

.btn-delete i {
    font-size: 14px;
}

/* Responsive */
@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
    }
    
    .btn-edit,
    .btn-delete {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function confirmDelete(id) {
    // Konfirmasi dengan SweetAlert2 jika tersedia, atau confirm biasa
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus petugas ini? Data yang sudah dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#eb5757',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    } else {
        // Fallback ke confirm biasa
        if (confirm('Apakah Anda yakin ingin menghapus petugas ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
}
</script>
@endsection
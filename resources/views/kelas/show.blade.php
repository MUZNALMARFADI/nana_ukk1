@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-eye"></i> Detail Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="detail-table">
            <tr>
                <th width="200">Nama Kelas</th>
                <td>{{ $kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <th>Kompetensi Keahlian</th>
                <td>{{ $kelas->kompetensi_keahlian }}</td>
            </tr>
            <tr>
                <th>Jumlah Siswa</th>
                <td>{{ $kelas->siswa->count() }} siswa</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">
            <i class="fas fa-users"></i> Daftar Siswa
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas->siswa as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->no_telp }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada siswa di kelas ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if(session('petugas')->level == 'admin')
        <div class="form-actions">
            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="btn-edit-detail">
                <i class="fas fa-edit"></i> Edit Data
            </a>
            <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-detail">
                    <i class="fas fa-trash-alt"></i> Hapus Data
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<style>
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e8f5e9;
}

.btn-edit-detail {
    padding: 12px 28px;
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
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
}

.btn-edit-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(243, 156, 18, 0.3);
    background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
}

.btn-delete-detail {
    padding: 12px 28px;
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-delete-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
}
</style>
@endsection
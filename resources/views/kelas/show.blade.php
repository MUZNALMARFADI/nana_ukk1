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
            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
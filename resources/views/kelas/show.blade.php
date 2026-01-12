@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<div class="content-header">
    <h1>👁️ Detail Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="detail-table">
            <tr>
                <th width="200">Nama Kelas</th>
                <td>{{ $kela->nama_kelas }}</td>
            </tr>
            <tr>
                <th>Kompetensi Keahlian</th>
                <td>{{ $kela->kompetensi_keahlian }}</td>
            </tr>
            <tr>
                <th>Jumlah Siswa</th>
                <td>{{ $kela->siswa->count() }} siswa</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">📋 Daftar Siswa</h3>
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
                @forelse($kela->siswa as $index => $siswa)
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

        <div class="form-actions">
            <a href="{{ route('kelas.edit', $kela->id_kelas) }}" class="btn-primary">✏️ Edit</a>
            <form action="{{ route('kelas.destroy', $kela->id_kelas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">🗑️ Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
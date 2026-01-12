@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="content-header">
    <h1>🏫 Data Kelas</h1>
    
    @if(session('petugas')->level == 'admin')
    <a href="{{ route('kelas.create') }}" class="btn-add">
        <i>➕</i> Tambah Kelas
    </a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-success">
    <span>✅</span>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <span>❌</span>
    <span>{{ session('error') }}</span>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kelas }}</td>
                    <td>{{ $item->kompetensi_keahlian }}</td>
                    <td>{{ $item->siswa_count }} siswa</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('kelas.show', $item->id_kelas) }}" class="btn-view">👁️ Lihat</a>
                            
                            @if(session('petugas')->level == 'admin')
                            <a href="{{ route('kelas.edit', $item->id_kelas) }}" class="btn-edit">✏️ Edit</a>
                            <form action="{{ route('kelas.destroy', $item->id_kelas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">🗑️ Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data kelas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
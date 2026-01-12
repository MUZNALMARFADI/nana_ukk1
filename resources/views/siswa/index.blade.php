@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="content-header">
    <h1>👥 Data Siswa</h1>
    
    @if(session('petugas')->level == 'admin')
    <a href="{{ route('siswa.create') }}" class="btn-add">
        <i>➕</i> Tambah Siswa
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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('siswa.show', $item->id) }}" class="btn-view">👁️ Lihat</a>
                                
                                @if(session('petugas')->level == 'admin')
                                <a href="{{ route('siswa.edit', $item->id) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="7" class="text-center">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
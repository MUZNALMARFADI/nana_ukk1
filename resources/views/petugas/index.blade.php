@extends('layouts.app')

@section('title', 'Data Petugas')

@section('content')
<div class="content-header">
    <h1>👨‍💼 Data Petugas</h1>
    <a href="{{ route('petugas.create') }}" class="btn-add">
        <i>➕</i> Tambah Petugas
    </a>
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
                    <th>Username</th>
                    <th>Nama Petugas</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_petugas }}</td>
                    <td>
                        <span class="badge badge-{{ $item->level == 'admin' ? 'primary' : 'success' }}">
                            {{ strtoupper($item->level) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('petugas.show', $item->id_petugas) }}" class="btn-view">👁️ Lihat</a>
                            <a href="{{ route('petugas.edit', $item->id_petugas) }}" class="btn-edit">✏️ Edit</a>
                            @if(session('petugas')->id_petugas != $item->id_petugas)
                            <form action="{{ route('petugas.destroy', $item->id_petugas) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <td colspan="5" class="text-center">Belum ada data petugas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
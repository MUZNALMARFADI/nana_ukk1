@extends('layouts.app')

@section('title', 'Data Petugas')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-user-tie"></i> Data Petugas</h1>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th><i class="fas fa-user"></i> Username</th>
                    <th><i class="fas fa-id-card"></i> Nama Petugas</th>
                    <th><i class="fas fa-shield-alt"></i> Level</th>
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
                            <i class="fas fa-{{ $item->level == 'admin' ? 'crown' : 'user-check' }}"></i>
                            {{ strtoupper($item->level) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('petugas.show', $item->id_petugas) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <i class="fas fa-inbox"></i> Belum ada data petugas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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
</style>
@endsection
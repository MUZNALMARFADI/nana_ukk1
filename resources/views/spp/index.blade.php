@extends('layouts.app')

@section('title', 'Data SPP')

@section('content')
<div class="content-header">
    <h1>💰 Data SPP</h1>
    
    @if(session('petugas')->level == 'admin')
    <a href="{{ route('spp.create') }}" class="btn-add">
        <i>➕</i> Tambah SPP
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
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spp as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('spp.show', $item->id_spp) }}" class="btn-view">👁️ Lihat</a>
                            
                            @if(session('petugas')->level == 'admin')
                            <a href="{{ route('spp.edit', $item->id_spp) }}" class="btn-edit">✏️ Edit</a>
                            <form action="{{ route('spp.destroy', $item->id_spp) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <td colspan="4" class="text-center">Belum ada data SPP</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
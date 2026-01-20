@extends('layouts.app')

@section('title', 'Detail SPP')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-eye"></i> Detail Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="detail-table">
            <tr>
                <th width="200"><i class="fas fa-calendar-alt"></i> Tahun</th>
                <td>{{ $spp->tahun }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-money-bill-wave"></i> Nominal</th>
                <td>Rp {{ number_format($spp->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-clock"></i> Dibuat pada</th>
                <td>{{ $spp->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-sync-alt"></i> Terakhir diupdate</th>
                <td>{{ $spp->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        @if(session('petugas')->level == 'admin')
        <div class="form-actions">
            <a href="{{ route('spp.edit', $spp->id_spp) }}" class="btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('spp.destroy', $spp->id_spp) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
@extends('layouts.app')

@section('title', 'Detail SPP')

@section('content')
<div class="content-header">
    <h1>👁️ Detail Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="detail-table">
            <tr>
                <th width="200">Tahun</th>
                <td>{{ $spp->tahun }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>Rp {{ number_format($spp->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Dibuat pada</th>
                <td>{{ $spp->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <th>Terakhir diupdate</th>
                <td>{{ $spp->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <div class="form-actions">
            <a href="{{ route('spp.edit', $spp->id_spp) }}" class="btn-primary">✏️ Edit</a>
            <form action="{{ route('spp.destroy', $spp->id_spp) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">🗑️ Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
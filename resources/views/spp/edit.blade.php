@extends('layouts.app')

@section('title', 'Edit SPP')

@section('content')
<div class="content-header">
    <h1>✏️ Edit Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="tahun">Tahun <span class="required">*</span></label>
                <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $spp->tahun) }}" required>
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nominal">Nominal <span class="required">*</span></label>
                <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal', $spp->nominal) }}" required>
                @error('nominal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Update</button>
                <a href="{{ route('spp.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
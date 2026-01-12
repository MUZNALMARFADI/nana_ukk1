@extends('layouts.app')

@section('title', 'Tambah SPP')

@section('content')
<div class="content-header">
    <h1>➕ Tambah Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('spp.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="tahun">Tahun <span class="required">*</span></label>
                <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}" placeholder="Contoh: 2025" required>
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nominal">Nominal <span class="required">*</span></label>
                <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" placeholder="Contoh: 175000" required>
                @error('nominal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Masukkan nominal tanpa titik atau koma</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Simpan</button>
                <a href="{{ route('spp.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
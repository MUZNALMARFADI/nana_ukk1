@extends('layouts.app')

@section('title', 'Edit SPP')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-edit"></i> Edit Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="tahun">
                    <i class="fas fa-calendar-alt"></i> Tahun <span class="required">*</span>
                </label>
                <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $spp->tahun) }}" placeholder="Contoh: 2025" required>
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nominal">
                    <i class="fas fa-money-bill-wave"></i> Nominal <span class="required">*</span>
                </label>
                <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal', $spp->nominal) }}" placeholder="Contoh: 175000" required>
                @error('nominal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text"><i class="fas fa-info-circle"></i> Masukkan nominal tanpa titik atau koma</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('spp.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
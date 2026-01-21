@extends('layouts.app')

@section('title', 'Tambah SPP')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-plus-circle"></i> Tambah Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <div>
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 5px 0 0 20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('spp.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="tahun">
                    <i class="fas fa-calendar-alt"></i> Tahun <span class="required">*</span>
                </label>
                <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}" placeholder="Contoh: 2025" min="2020" max="2100" required>
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text"><i class="fas fa-info-circle"></i> Masukkan tahun ajaran SPP (4 digit)</small>
            </div>

            <div class="form-group">
                <label for="nominal">
                    <i class="fas fa-money-bill-wave"></i> Nominal <span class="required">*</span>
                </label>
                <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" placeholder="Contoh: 175000" min="0" required>
                @error('nominal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text"><i class="fas fa-info-circle"></i> Masukkan nominal tanpa titik atau koma</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('spp.index') }}" class="btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-text {
    display: block;
    margin-top: 5px;
    color: #7f8c8d;
    font-size: 13px;
}
</style>
@endsection
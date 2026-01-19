@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-plus-circle"></i> Tambah Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nama_kelas">
                    <i class="fas fa-door-open"></i> Nama Kelas <span class="required">*</span>
                </label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}" placeholder="Contoh: X RPL 1" maxlength="10" required>
                @error('nama_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kompetensi_keahlian">
                    <i class="fas fa-graduation-cap"></i> Kompetensi Keahlian <span class="required">*</span>
                </label>
                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" value="{{ old('kompetensi_keahlian') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" maxlength="50" required>
                @error('kompetensi_keahlian')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('kelas.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
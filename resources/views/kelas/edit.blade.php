@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="content-header">
    <h1>✏️ Edit Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kelas.update', $kela->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas <span class="required">*</span></label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kela->nama_kelas) }}" maxlength="10" required>
                @error('nama_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kompetensi_keahlian">Kompetensi Keahlian <span class="required">*</span></label>
                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" value="{{ old('kompetensi_keahlian', $kela->kompetensi_keahlian) }}" maxlength="50" required>
                @error('kompetensi_keahlian')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Update</button>
                <a href="{{ route('kelas.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
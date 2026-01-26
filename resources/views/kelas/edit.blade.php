@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-edit"></i> Edit Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_kelas">
                    <i class="fas fa-door-open"></i> Nama Kelas <span class="required">*</span>
                </label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" maxlength="10" required>
                @error('nama_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kompetensi_keahlian">
                    <i class="fas fa-graduation-cap"></i> Kompetensi Keahlian <span class="required">*</span>
                </label>
                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" value="{{ old('kompetensi_keahlian', $kelas->kompetensi_keahlian) }}" maxlength="50" required>
                @error('kompetensi_keahlian')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Update Data
                </button>
                <a href="{{ route('kelas.index') }}" class="btn-cancel">
                    <i class="fas fa-times-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.btn-save {
    padding: 12px 28px;
    background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(82, 190, 128, 0.3);
    background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);
}

.btn-cancel {
    padding: 12px 28px;
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-cancel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
}
</style>
@endsection
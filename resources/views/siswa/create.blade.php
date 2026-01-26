@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="content-header">
    <h1>Tambah Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('siswa.store') }}" method="POST" id="formSiswa">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nisn">NISN <span class="required">*</span></label>
                        <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" placeholder="10 digit" maxlength="10" required>
                        @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nis">NIS <span class="required">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" placeholder="8 digit" maxlength="8" required>
                        @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama lengkap siswa" maxlength="35" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_kelas">Kelas <span class="required">*</span></label>
                <select name="id_kelas" id="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                    </option>
                    @endforeach
                </select>
                @error('id_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat <span class="required">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telp">No. Telepon <span class="required">*</span></label>
                <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx" maxlength="13" required>
                @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_spp">SPP <span class="required">*</span></label>
                <select name="id_spp" id="id_spp" class="form-control @error('id_spp') is-invalid @enderror" required>
                    <option value="">-- Pilih Tahun SPP --</option>
                    @foreach($spp as $s)
                    <option value="{{ $s->id_spp }}" {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                        {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
                @error('id_spp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <button type="reset" class="btn-reset" onclick="return confirm('Yakin ingin mereset semua input?')">
                    <i class="fas fa-redo-alt"></i> Reset Form
                </button>
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

.btn-reset {
    padding: 12px 28px;
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
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

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(243, 156, 18, 0.3);
    background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
}
</style>
@endsection
@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-edit"></i> Edit Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nisn">
                            <i class="fas fa-id-card"></i> NISN <span class="required">*</span>
                        </label>
                        <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $siswa->nisn) }}" maxlength="10" required>
                        @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nis">
                            <i class="fas fa-id-badge"></i> NIS <span class="required">*</span>
                        </label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis', $siswa->nis) }}" maxlength="8" required>
                        @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="nama">
                    <i class="fas fa-user"></i> Nama Lengkap <span class="required">*</span>
                </label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $siswa->nama) }}" maxlength="35" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_kelas">
                    <i class="fas fa-door-open"></i> Kelas <span class="required">*</span>
                </label>
                <select name="id_kelas" id="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas', $siswa->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                    </option>
                    @endforeach
                </select>
                @error('id_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">
                    <i class="fas fa-map-marker-alt"></i> Alamat <span class="required">*</span>
                </label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telp">
                    <i class="fas fa-phone"></i> No. Telepon <span class="required">*</span>
                </label>
                <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $siswa->no_telp) }}" maxlength="13" required>
                @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_spp">
                    <i class="fas fa-money-bill-wave"></i> SPP <span class="required">*</span>
                </label>
                <select name="id_spp" id="id_spp" class="form-control @error('id_spp') is-invalid @enderror" required>
                    <option value="">-- Pilih Tahun SPP --</option>
                    @foreach($spp as $s)
                    <option value="{{ $s->id_spp }}" {{ old('id_spp', $siswa->id_spp) == $s->id_spp ? 'selected' : '' }}>
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
                    <i class="fas fa-save"></i> Update Data
                </button>
                <a href="{{ route('siswa.index') }}" class="btn-cancel">
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
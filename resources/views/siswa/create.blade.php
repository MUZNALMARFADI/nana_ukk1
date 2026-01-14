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
        <form action="{{ route('siswa.store') }}" method="POST">
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
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('siswa.index') }}" class="btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
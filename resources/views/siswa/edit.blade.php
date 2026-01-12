@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="content-header">
    <h1>✏️ Edit Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
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
                        <label for="nisn">NISN <span class="required">*</span></label>
                        <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $siswa->nisn) }}" maxlength="10" required>
                        @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nis">NIS <span class="required">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis', $siswa->nis) }}" maxlength="8" required>
                        @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $siswa->nama) }}" maxlength="35" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_kelas">Kelas <span class="required">*</span></label>
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
                <label for="alamat">Alamat <span class="required">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telp">No. Telepon <span class="required">*</span></label>
                <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $siswa->no_telp) }}" maxlength="13" required>
                @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_spp">SPP <span class="required">*</span></label>
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
                <button type="submit" class="btn-primary">💾 Update</button>
                <a href="{{ route('siswa.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="content-header">
    <h1>➕ Tambah Data Petugas</h1>
    <a href="{{ route('petugas.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username untuk login" maxlength="25" required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_petugas">Nama Petugas <span class="required">*</span></label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ old('nama_petugas') }}" placeholder="Nama lengkap petugas" maxlength="35" required>
                @error('nama_petugas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="level">Level <span class="required">*</span></label>
                <select name="level" id="level" class="form-control @error('level') is-invalid @enderror" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('level') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                @error('level')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Simpan</button>
                <a href="{{ route('petugas.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
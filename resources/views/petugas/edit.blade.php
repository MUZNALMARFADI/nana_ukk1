@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="content-header">
    <h1>✏️ Edit Data Petugas</h1>
    <a href="{{ route('petugas.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('petugas.update', $petuga->id_petugas) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $petuga->username) }}" maxlength="25" required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Biarkan kosong jika tidak ingin mengubah password</small>
            </div>

            <div class="form-group">
                <label for="nama_petugas">Nama Petugas <span class="required">*</span></label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ old('nama_petugas', $petuga->nama_petugas) }}" maxlength="35" required>
                @error('nama_petugas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="level">Level <span class="required">*</span></label>
                <select name="level" id="level" class="form-control @error('level') is-invalid @enderror" required>
                    <option value="admin" {{ old('level', $petuga->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('level', $petuga->level) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                @error('level')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Update</button>
                <a href="{{ route('petugas.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
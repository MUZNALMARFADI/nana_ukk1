@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-edit"></i> Edit Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nisn">
                    <i class="fas fa-user-graduate"></i> NISN Siswa <span class="required">*</span>
                </label>
                <select name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}" {{ old('nisn', $pembayaran->nisn) == $s->nisn ? 'selected' : '' }}>
                        {{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                    </option>
                    @endforeach
                </select>
                @error('nisn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_bayar">
                            <i class="fas fa-calendar"></i> Tanggal Bayar <span class="required">*</span>
                        </label>
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror" value="{{ old('tgl_bayar', $pembayaran->tgl_bayar->format('Y-m-d')) }}" required>
                        @error('tgl_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan_dibayar">
                            <i class="fas fa-calendar-alt"></i> Bulan Dibayar <span class="required">*</span>
                        </label>
                        <select name="bulan_dibayar" id="bulan_dibayar" class="form-control @error('bulan_dibayar') is-invalid @enderror" required>
                            <option value="">-- Pilih Bulan --</option>
                            @foreach($bulan as $b)
                            <option value="{{ $b }}" {{ old('bulan_dibayar', $pembayaran->bulan_dibayar) == $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        </select>
                        @error('bulan_dibayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun_dibayar">
                            <i class="fas fa-calendar-check"></i> Tahun Dibayar <span class="required">*</span>
                        </label>
                        <input type="text" name="tahun_dibayar" id="tahun_dibayar" class="form-control @error('tahun_dibayar') is-invalid @enderror" value="{{ old('tahun_dibayar', $pembayaran->tahun_dibayar) }}" maxlength="4" required>
                        @error('tahun_dibayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_spp">
                            <i class="fas fa-file-invoice-dollar"></i> Tahun SPP <span class="required">*</span>
                        </label>
                        <select name="id_spp" id="id_spp" class="form-control @error('id_spp') is-invalid @enderror" required>
                            <option value="">-- Pilih Tahun SPP --</option>
                            @foreach($spp as $s)
                            <option value="{{ $s->id_spp }}" {{ old('id_spp', $pembayaran->id_spp) == $s->id_spp ? 'selected' : '' }}>
                                {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_spp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="jumlah_bayar">
                    <i class="fas fa-money-bill"></i> Jumlah Bayar <span class="required">*</span>
                </label>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required>
                @error('jumlah_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('pembayaran.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
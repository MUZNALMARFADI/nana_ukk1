@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="content-header">
    <h1>➕ Entri Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i>⬅️</i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
            @csrf
            
            <div class="form-group">
                <label for="nisn">NISN Siswa <span class="required">*</span></label>
                <select name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}" data-nama="{{ $s->nama }}" data-kelas="{{ $s->kelas->nama_kelas ?? '-' }}" data-spp="{{ $s->spp->nominal ?? 0 }}" {{ old('nisn') == $s->nisn ? 'selected' : '' }}>
                        {{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                    </option>
                    @endforeach
                </select>
                @error('nisn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Info Siswa -->
            <div id="infoSiswa" style="display: none; background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">📋 Informasi Siswa</h4>
                <table class="detail-table" style="background: white;">
                    <tr>
                        <th width="150">Nama</th>
                        <td id="info_nama">-</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td id="info_kelas">-</td>
                    </tr>
                    <tr>
                        <th>Nominal SPP</th>
                        <td id="info_spp">-</td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_bayar">Tanggal Bayar <span class="required">*</span></label>
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror" value="{{ old('tgl_bayar', date('Y-m-d')) }}" required>
                        @error('tgl_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan_dibayar">Bulan Dibayar <span class="required">*</span></label>
                        <select name="bulan_dibayar" id="bulan_dibayar" class="form-control @error('bulan_dibayar') is-invalid @enderror" required>
                            <option value="">-- Pilih Bulan --</option>
                            @foreach($bulan as $b)
                            <option value="{{ $b }}" {{ old('bulan_dibayar') == $b ? 'selected' : '' }}>{{ $b }}</option>
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
                        <label for="tahun_dibayar">Tahun Dibayar <span class="required">*</span></label>
                        <input type="text" name="tahun_dibayar" id="tahun_dibayar" class="form-control @error('tahun_dibayar') is-invalid @enderror" value="{{ old('tahun_dibayar', date('Y')) }}" maxlength="4" required>
                        @error('tahun_dibayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_spp">Tahun SPP <span class="required">*</span></label>
                        <select name="id_spp" id="id_spp" class="form-control @error('id_spp') is-invalid @enderror" required>
                            <option value="">-- Pilih Tahun SPP --</option>
                            @foreach($spp as $s)
                            <option value="{{ $s->id_spp }}" data-nominal="{{ $s->nominal }}" {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
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
                <label for="jumlah_bayar">Jumlah Bayar <span class="required">*</span></label>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" placeholder="Masukkan jumlah pembayaran" required>
                @error('jumlah_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Simpan Pembayaran</button>
                <a href="{{ route('pembayaran.index') }}" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nisnSelect = document.getElementById('nisn');
    const sppSelect = document.getElementById('id_spp');
    const jumlahBayarInput = document.getElementById('jumlah_bayar');
    const infoSiswa = document.getElementById('infoSiswa');

    // Show siswa info when selected
    nisnSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (this.value) {
            document.getElementById('info_nama').textContent = selected.dataset.nama;
            document.getElementById('info_kelas').textContent = selected.dataset.kelas;
            document.getElementById('info_spp').textContent = 'Rp ' + parseInt(selected.dataset.spp).toLocaleString('id-ID');
            infoSiswa.style.display = 'block';
        } else {
            infoSiswa.style.display = 'none';
        }
    });

    // Auto fill jumlah bayar when SPP selected
    sppSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (this.value && selected.dataset.nominal) {
            jumlahBayarInput.value = selected.dataset.nominal;
        }
    });

    // Trigger on page load if old value exists
    if (nisnSelect.value) {
        nisnSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
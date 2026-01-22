@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-plus-circle"></i> Entri Pembayaran SPP</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
            @csrf
            
            <!-- Filter Kelas -->
            <div class="form-group">
                <label for="filter_kelas">
                    <i class="fas fa-filter"></i> Filter Berdasarkan Kelas
                </label>
                <select id="filter_kelas" class="form-control">
                    <option value="">-- Tampilkan Semua Kelas --</option>
                    @foreach($siswa->unique('kelas.nama_kelas')->sortBy('kelas.nama_kelas') as $s)
                        @if($s->kelas)
                        <option value="{{ $s->kelas->nama_kelas }}">{{ $s->kelas->nama_kelas }}</option>
                        @endif
                    @endforeach
                </select>
                <small style="color: #7f8c8d; display: block; margin-top: 5px;">
                    <i class="fas fa-info-circle"></i> Pilih kelas untuk memfilter daftar siswa
                </small>
            </div>

            <div class="form-group">
                <label for="nisn">
                    <i class="fas fa-user-graduate"></i> NISN Siswa <span class="required">*</span>
                </label>
                <select name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}" 
                            data-nama="{{ $s->nama }}" 
                            data-kelas="{{ $s->kelas->nama_kelas ?? '-' }}" 
                            data-spp="{{ $s->spp->nominal ?? 0 }}" 
                            class="siswa-option" 
                            {{ old('nisn') == $s->nisn ? 'selected' : '' }}>
                        {{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                    </option>
                    @endforeach
                </select>
                @error('nisn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small id="siswaCount" style="color: #7f8c8d; display: block; margin-top: 5px;">
                    <i class="fas fa-users"></i> Menampilkan <span id="countNumber">{{ $siswa->count() }}</span> siswa
                </small>
            </div>

            <!-- Info Siswa -->
            <div id="infoSiswa" style="display: none; background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">
                    <i class="fas fa-info-circle"></i> Informasi Siswa
                </h4>
                <table class="detail-table" style="background: white;">
                    <tr>
                        <th width="150"><i class="fas fa-user"></i> Nama</th>
                        <td id="info_nama">-</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-door-open"></i> Kelas</th>
                        <td id="info_kelas">-</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-money-bill-wave"></i> Nominal SPP</th>
                        <td id="info_spp">-</td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_bayar">
                            <i class="fas fa-calendar"></i> Tanggal Bayar <span class="required">*</span>
                        </label>
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror" value="{{ old('tgl_bayar', date('Y-m-d')) }}" required>
                        @error('tgl_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun_dibayar">
                            <i class="fas fa-calendar-check"></i> Tahun Dibayar <span class="required">*</span>
                        </label>
                        <input type="text" name="tahun_dibayar" id="tahun_dibayar" class="form-control @error('tahun_dibayar') is-invalid @enderror" value="{{ old('tahun_dibayar', date('Y')) }}" maxlength="4" required>
                        @error('tahun_dibayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- FITUR BARU: Pilihan Bayar Single atau Multiple -->
            <div class="form-group">
                <label>
                    <i class="fas fa-layer-group"></i> Tipe Pembayaran <span class="required">*</span>
                </label>
                <div style="display: flex; gap: 20px; margin-top: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="radio" name="tipe_bayar" value="single" id="tipeSingle" checked>
                        <span>Bayar 1 Bulan</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="radio" name="tipe_bayar" value="multiple" id="tipeMultiple">
                        <span>Bayar Beberapa Bulan Sekaligus</span>
                    </label>
                </div>
            </div>

            <!-- Form untuk Single Payment -->
            <div id="singlePayment">
                <div class="form-group">
                    <label for="bulan_dibayar_single">
                        <i class="fas fa-calendar-alt"></i> Bulan Dibayar <span class="required">*</span>
                    </label>
                    <select name="bulan_dibayar_single" id="bulan_dibayar_single" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach($bulan as $b)
                        <option value="{{ $b }}" {{ old('bulan_dibayar_single') == $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Form untuk Multiple Payment -->
            <div id="multiplePayment" style="display: none;">
                <div class="form-group">
                    <label>
                        <i class="fas fa-calendar-alt"></i> Pilih Bulan yang Dibayar <span class="required">*</span>
                    </label>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border: 2px solid #d5f4e6;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                            @foreach($bulan as $b)
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 8px; background: white; border-radius: 6px; border: 1px solid #e0e0e0; transition: all 0.3s;">
                                <input type="checkbox" name="bulan_multiple[]" value="{{ $b }}" class="bulan-checkbox" style="width: 18px; height: 18px; cursor: pointer;">
                                <span>{{ $b }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <small style="color: #7f8c8d; display: block; margin-top: 8px;">
                        <i class="fas fa-info-circle"></i> Centang beberapa bulan untuk pembayaran sekaligus
                    </small>
                </div>
            </div>

            <div class="form-group">
                <label for="id_spp">
                    <i class="fas fa-file-invoice-dollar"></i> Tahun SPP <span class="required">*</span>
                </label>
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

            <!-- Info Pembayaran -->
            <div id="infoPembayaran" style="display: none; background: #e8f5e9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #27ae60;">
                <h4 style="margin-bottom: 10px; color: #27ae60;">
                    <i class="fas fa-calculator"></i> Ringkasan Pembayaran
                </h4>
                <table style="width: 100%;">
                    <tr>
                        <td><strong>Jumlah Bulan:</strong></td>
                        <td id="info_jumlah_bulan" style="text-align: right;">-</td>
                    </tr>
                    <tr>
                        <td><strong>Nominal per Bulan:</strong></td>
                        <td id="info_nominal_per_bulan" style="text-align: right;">-</td>
                    </tr>
                    <tr style="border-top: 2px solid #27ae60;">
                        <td><strong style="font-size: 16px; color: #27ae60;">TOTAL BAYAR:</strong></td>
                        <td id="info_total" style="text-align: right; font-size: 18px; font-weight: bold; color: #27ae60;">-</td>
                    </tr>
                </table>
            </div>

            <div class="form-group">
                <label for="jumlah_bayar">
                    <i class="fas fa-money-bill"></i> Total Jumlah Bayar <span class="required">*</span>
                </label>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" placeholder="Total akan terisi otomatis" readonly style="background: #f8f9fa; font-weight: bold; font-size: 16px; color: #27ae60;">
                @error('jumlah_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Pembayaran
                </button>
                <a href="{{ route('pembayaran.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.col-md-6 {
    width: 50%;
    float: left;
    padding: 0 10px;
}

@media (max-width: 768px) {
    .col-md-6 {
        width: 100%;
        float: none;
    }
}

/* Checkbox styling */
input[type="checkbox"]:checked + span {
    font-weight: bold;
    color: #27ae60;
}

label:has(input[type="checkbox"]:checked) {
    background: #d5f4e6 !important;
    border-color: #27ae60 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nisnSelect = document.getElementById('nisn');
    const sppSelect = document.getElementById('id_spp');
    const jumlahBayarInput = document.getElementById('jumlah_bayar');
    const infoSiswa = document.getElementById('infoSiswa');
    const filterKelas = document.getElementById('filter_kelas');
    
    const tipeSingle = document.getElementById('tipeSingle');
    const tipeMultiple = document.getElementById('tipeMultiple');
    const singlePayment = document.getElementById('singlePayment');
    const multiplePayment = document.getElementById('multiplePayment');
    const bulanCheckboxes = document.querySelectorAll('.bulan-checkbox');
    const infoPembayaran = document.getElementById('infoPembayaran');

    // Filter siswa by kelas
    filterKelas.addEventListener('change', function() {
        const selectedKelas = this.value;
        const allOptions = nisnSelect.querySelectorAll('.siswa-option');
        let visibleCount = 0;

        allOptions.forEach(option => {
            if (selectedKelas === '' || option.dataset.kelas === selectedKelas) {
                option.style.display = 'block';
                visibleCount++;
            } else {
                option.style.display = 'none';
            }
        });

        // Reset selection if current selected is hidden
        if (nisnSelect.value) {
            const currentOption = nisnSelect.options[nisnSelect.selectedIndex];
            if (currentOption.style.display === 'none') {
                nisnSelect.value = '';
                infoSiswa.style.display = 'none';
                calculateTotal();
            }
        }

        // Update count
        document.getElementById('countNumber').textContent = visibleCount;
    });

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
        calculateTotal();
    });

    // Toggle payment type
    tipeSingle.addEventListener('change', function() {
        if (this.checked) {
            singlePayment.style.display = 'block';
            multiplePayment.style.display = 'none';
            document.getElementById('bulan_dibayar_single').required = true;
            bulanCheckboxes.forEach(cb => {
                cb.checked = false;
                cb.required = false;
            });
            calculateTotal();
        }
    });

    tipeMultiple.addEventListener('change', function() {
        if (this.checked) {
            singlePayment.style.display = 'none';
            multiplePayment.style.display = 'block';
            document.getElementById('bulan_dibayar_single').required = false;
            calculateTotal();
        }
    });

    // Auto calculate when SPP or month selected
    sppSelect.addEventListener('change', calculateTotal);
    document.getElementById('bulan_dibayar_single').addEventListener('change', calculateTotal);
    bulanCheckboxes.forEach(cb => {
        cb.addEventListener('change', calculateTotal);
    });

    function calculateTotal() {
        const sppSelected = sppSelect.options[sppSelect.selectedIndex];
        const nominalPerBulan = sppSelected.dataset.nominal ? parseInt(sppSelected.dataset.nominal) : 0;
        
        let jumlahBulan = 0;
        let totalBayar = 0;

        if (tipeSingle.checked) {
            // Single payment
            const bulanSingle = document.getElementById('bulan_dibayar_single').value;
            if (bulanSingle) {
                jumlahBulan = 1;
                totalBayar = nominalPerBulan;
            }
        } else {
            // Multiple payment
            const checkedBulans = Array.from(bulanCheckboxes).filter(cb => cb.checked);
            jumlahBulan = checkedBulans.length;
            totalBayar = nominalPerBulan * jumlahBulan;
        }

        // Update display
        if (jumlahBulan > 0 && nominalPerBulan > 0) {
            document.getElementById('info_jumlah_bulan').textContent = jumlahBulan + ' bulan';
            document.getElementById('info_nominal_per_bulan').textContent = 'Rp ' + nominalPerBulan.toLocaleString('id-ID');
            document.getElementById('info_total').textContent = 'Rp ' + totalBayar.toLocaleString('id-ID');
            infoPembayaran.style.display = 'block';
            jumlahBayarInput.value = totalBayar;
        } else {
            infoPembayaran.style.display = 'none';
            jumlahBayarInput.value = '';
        }
    }

    // Trigger on page load if old value exists
    if (nisnSelect.value) {
        nisnSelect.dispatchEvent(new Event('change'));
    }

    // Form validation
    document.getElementById('formPembayaran').addEventListener('submit', function(e) {
        if (tipeMultiple.checked) {
            const checkedBulans = Array.from(bulanCheckboxes).filter(cb => cb.checked);
            if (checkedBulans.length === 0) {
                e.preventDefault();
                alert('Pilih minimal 1 bulan untuk pembayaran!');
                return false;
            }
        }
    });
});
</script>
@endsection
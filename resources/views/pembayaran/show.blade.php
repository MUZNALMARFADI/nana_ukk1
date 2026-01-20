@extends('layouts.app')

@section('title', 'Struk Pembayaran')

@section('content')
<div class="content-header no-print">
    <h1><i class="fas fa-receipt"></i> Struk Digital</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="receipt-wrapper">
    <div class="receipt-card">
        <div class="receipt-header">
            <div class="school-logo">
                <i class="fas fa-university"></i>
            </div>
            <h2>SMK NEGERI INDONESIA</h2>
            <p>Jl. Pendidikan No. 45, Jakarta</p>
            <p>Telp: 021-123456</p>
            <div class="divider">***************************</div>
        </div>

        <div class="receipt-body">
            <div class="info-row">
                <span>No. Bukti:</span>
                <span>#{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span>Tanggal:</span>
                <span>{{ $pembayaran->tgl_bayar->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span>Petugas:</span>
                <span>{{ $pembayaran->petugas->nama_petugas ?? '-' }}</span>
            </div>
            <div class="divider">-------------------------------</div>

            <div class="student-info">
                <p><strong>{{ $pembayaran->siswa->nama ?? '-' }}</strong></p>
                <p>{{ $pembayaran->nisn }} | {{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</p>
            </div>
            <div class="divider">-------------------------------</div>

            <div class="item-list">
                <div class="item-row">
                    <span>SPP {{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</span>
                    <span>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="divider">***********************</div>

            <div class="total-section">
                <div class="info-row total">
                    <span>TOTAL BAYAR</span>
                    <span>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                </div>
                <div class="info-row status">
                    <span>STATUS</span>
                    <span>LUNAS</span>
                </div>
            </div>
        </div>

        <div class="receipt-footer">
            <div class="divider">*****************************</div>
            <p>Simpan struk ini sebagai</p>
            <p>bukti pembayaran yang sah.</p>
            <p>Terima Kasih</p>
            <div class="qr-code">
                <i class="fas fa-qrcode"></i>
            </div>
        </div>
    </div>

    <div class="receipt-actions no-print">
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print"></i> Cetak Struk
        </button>
        <form action="{{ route('pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-delete">Hapus</button>
        </form>
    </div>
</div>

<style>
/* CSS UNTUK TAMPILAN DASHBOARD */
.receipt-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.receipt-card {
    background: #fff;
    width: 350px; /* Ukuran lebar struk standar */
    padding: 30px 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    font-family: 'Courier New', Courier, monospace; /* Font khas struk */
    color: #333;
}

.receipt-header { text-align: center; margin-bottom: 15px; }
.school-logo { font-size: 40px; color: #2e7d32; margin-bottom: 10px; }
.receipt-header h2 { font-size: 18px; margin: 0; }
.receipt-header p { font-size: 12px; margin: 2px 0; }

.info-row { display: flex; justify-content: space-between; font-size: 13px; margin: 5px 0; }
.divider { text-align: center; margin: 10px 0; letter-spacing: 2px; }

.student-info { text-align: left; font-size: 14px; }
.item-row { display: flex; justify-content: space-between; font-weight: bold; margin: 10px 0; }

.total { font-weight: bold; font-size: 16px; border-top: 1px dashed #333; padding-top: 10px; }
.status { font-weight: bold; color: #2e7d32; margin-top: 5px; }

.receipt-footer { text-align: center; font-size: 12px; margin-top: 20px; }
.qr-code { font-size: 40px; margin-top: 10px; opacity: 0.8; }

.receipt-actions { margin-top: 30px; display: flex; gap: 10px; }
.btn-print { background: #2e7d32; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
.btn-delete { background: #fee2e2; color: #ef4444; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }

/* CSS KHUSUS CETAK */
@media print {
    .no-print, nav, footer, .sidebar, .content-header { display: none !important; }
    body { background: white !important; display: flex; justify-content: center; padding: 0; }
    .receipt-card { 
        box-shadow: none !important; 
        border: none !important; 
        width: 100%; 
        max-width: 80mm; /* Lebar standar kertas thermal */
        margin: 0;
    }
    .receipt-wrapper { padding: 0; }
    @page { margin: 0; size: 80mm 200mm; } /* Mengatur ukuran kertas printer thermal */
}
</style>
@endsection
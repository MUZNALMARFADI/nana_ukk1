<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = session('siswa');
        
        // Ambil data pembayaran siswa
        $pembayaran = Pembayaran::where('nisn', $siswa->nisn)
                                ->with(['petugas', 'spp'])
                                ->orderBy('tahun_dibayar', 'desc')
                                ->orderBy('bulan_dibayar', 'desc')
                                ->get();
        
        // Hitung total pembayaran
        $totalBayar = $pembayaran->sum('jumlah_bayar');
        
        // Hitung pembayaran tahun ini
        $tahunIni = date('Y');
        $bayarTahunIni = Pembayaran::where('nisn', $siswa->nisn)
                                   ->where('tahun_dibayar', $tahunIni)
                                   ->sum('jumlah_bayar');
        
        // Hitung jumlah bulan yang sudah dibayar tahun ini
        $bulanDibayar = Pembayaran::where('nisn', $siswa->nisn)
                                  ->where('tahun_dibayar', $tahunIni)
                                  ->count();
        
        return view('siswa.dashboard', compact(
            'siswa',
            'pembayaran',
            'totalBayar',
            'bayarTahunIni',
            'bulanDibayar'
        ));
    }
    
    public function historyPembayaran()
    {
        $siswa = session('siswa');
        
        $pembayaran = Pembayaran::where('nisn', $siswa->nisn)
                                ->with(['petugas', 'spp'])
                                ->orderBy('tgl_bayar', 'desc')
                                ->paginate(15);
        
        return view('siswa.history', compact('siswa', 'pembayaran'));
    }
}
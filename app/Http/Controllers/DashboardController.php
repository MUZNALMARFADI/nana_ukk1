<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalKelas = Kelas::count();
        $totalPembayaran = Pembayaran::sum('jumlah_bayar');
        $pembayaranBulanIni = Pembayaran::whereMonth('tgl_bayar', date('m'))
                                        ->whereYear('tgl_bayar', date('Y'))
                                        ->sum('jumlah_bayar');

        return view('admin.dashboard', compact(
            'totalSiswa', 
            'totalKelas', 
            'totalPembayaran', 
            'pembayaranBulanIni'
        ));
    }
}
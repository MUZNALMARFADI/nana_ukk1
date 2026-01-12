<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Halaman utama laporan
    public function index()
    {
        return view('laporan.index');
    }

    // Generate laporan pembayaran
    public function pembayaran(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'petugas', 'spp']);

        // Filter berdasarkan bulan
        if ($request->bulan) {
            $query->where('bulan_dibayar', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->tahun) {
            $query->where('tahun_dibayar', $request->tahun);
        }

        // Filter berdasarkan kelas
        if ($request->kelas) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('id_kelas', $request->kelas);
            });
        }

        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->get();
        $totalPembayaran = $pembayaran->sum('jumlah_bayar');

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Jika ada request untuk download PDF
        if ($request->has('download')) {
            $pdf = PDF::loadView('laporan.pembayaran-pdf', compact('pembayaran', 'totalPembayaran', 'request'));
            return $pdf->download('laporan-pembayaran-' . date('Y-m-d') . '.pdf');
        }

        return view('laporan.pembayaran', compact('pembayaran', 'totalPembayaran', 'kelas', 'bulan'));
    }

    // Laporan tunggakan
    public function tunggakan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran' => function($q) use ($tahun) {
            $q->where('tahun_dibayar', $tahun);
        }])->get();

        $dataTunggakan = [];

        foreach ($siswa as $s) {
            $bulanDibayar = $s->pembayaran->pluck('bulan_dibayar')->toArray();
            $bulanBelumBayar = array_diff([
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ], $bulanDibayar);

            if (count($bulanBelumBayar) > 0) {
                $dataTunggakan[] = [
                    'siswa' => $s,
                    'bulan_belum_bayar' => $bulanBelumBayar,
                    'jumlah_tunggakan' => count($bulanBelumBayar) * ($s->spp->nominal ?? 0)
                ];
            }
        }

        // Jika download PDF
        if ($request->has('download')) {
            $pdf = PDF::loadView('laporan.tunggakan-pdf', compact('dataTunggakan', 'tahun'));
            return $pdf->download('laporan-tunggakan-' . $tahun . '.pdf');
        }

        return view('laporan.tunggakan', compact('dataTunggakan', 'tahun'));
    }

    // Laporan per kelas
    public function perKelas(Request $request)
    {
        $kelasId = $request->kelas_id;
        $tahun = $request->tahun ?? date('Y');

        $kelas = Kelas::with(['siswa.pembayaran' => function($q) use ($tahun) {
            $q->where('tahun_dibayar', $tahun);
        }])->get();

        if ($kelasId) {
            $kelas = $kelas->where('id_kelas', $kelasId);
        }

        $dataKelas = [];
        foreach ($kelas as $k) {
            $totalSiswa = $k->siswa->count();
            $totalPembayaran = $k->siswa->sum(function($siswa) {
                return $siswa->pembayaran->sum('jumlah_bayar');
            });

            $dataKelas[] = [
                'kelas' => $k,
                'total_siswa' => $totalSiswa,
                'total_pembayaran' => $totalPembayaran
            ];
        }

        $allKelas = Kelas::orderBy('nama_kelas')->get();

        // Jika download PDF
        if ($request->has('download')) {
            $pdf = PDF::loadView('laporan.per-kelas-pdf', compact('dataKelas', 'tahun'));
            return $pdf->download('laporan-per-kelas-' . $tahun . '.pdf');
        }

        return view('laporan.per-kelas', compact('dataKelas', 'allKelas', 'tahun'));
    }
}
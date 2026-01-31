<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar transaksi (Index)
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with(['siswa', 'petugas', 'spp']);

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter Bulan & Tahun
        if ($request->filled('bulan')) $query->where('bulan_dibayar', $request->bulan);
        if ($request->filled('tahun')) $query->where('tahun_dibayar', $request->tahun);

        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->paginate(10);
        
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Form Tambah Pembayaran (Create)
     */
    public function create()
    {
        $siswa = Siswa::with(['kelas', 'spp'])->orderBy('nama')->get();
        $spp = Spp::orderBy('tahun', 'desc')->get();
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return view('pembayaran.create', compact('siswa', 'spp', 'bulan'));
    }

    /**
     * Proses Simpan (Store) - Mendukung Single, Multiple & Full Year
     */
    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'nisn'          => 'required|exists:siswa,nisn',
            'tgl_bayar'     => 'required|date',
            'tahun_dibayar' => 'required|string|size:4',
            'id_spp'        => 'required|exists:spp,id_spp',
            'jumlah_bayar'  => 'required|integer|min:0',
            'tipe_bayar'    => 'required|in:single,multiple,full_year',
        ]);

        $id_petugas = session('petugas')->id_petugas;
        $tipeBayar  = $request->input('tipe_bayar');

        return DB::transaction(function () use ($request, $tipeBayar, $id_petugas) {
            $spp = Spp::find($request->id_spp);
            
            // 1. SINGLE PAYMENT (1 Bulan)
            if ($tipeBayar === 'single') {
                $request->validate(['bulan_dibayar_single' => 'required']);
                $bulan = $request->bulan_dibayar_single;

                // Cek duplikasi
                if (Pembayaran::where([
                    'nisn' => $request->nisn, 
                    'bulan_dibayar' => $bulan, 
                    'tahun_dibayar' => $request->tahun_dibayar
                ])->exists()) {
                    return back()->with('error', "Pembayaran bulan $bulan tahun {$request->tahun_dibayar} sudah ada!")->withInput();
                }

                Pembayaran::create([
                    'id_petugas'    => $id_petugas,
                    'nisn'          => $request->nisn,
                    'tgl_bayar'     => $request->tgl_bayar,
                    'bulan_dibayar' => $bulan,
                    'tahun_dibayar' => $request->tahun_dibayar,
                    'id_spp'        => $request->id_spp,
                    'jumlah_bayar'  => $spp->nominal,
                ]);

                return redirect()->route('pembayaran.index')
                    ->with('success', 'Pembayaran 1 bulan berhasil disimpan!');
            } 
            
            // 2. MULTIPLE PAYMENT (Beberapa Bulan)
            elseif ($tipeBayar === 'multiple') {
                $request->validate([
                    'bulan_multiple' => 'required|array|min:1',
                    'bulan_multiple.*' => 'required|string'
                ]);

                $bulanDibayar = $request->bulan_multiple;
                $jumlahBulan = count($bulanDibayar);
                $bulanBerhasil = 0;
                $bulanGagal = [];

                foreach ($bulanDibayar as $bulan) {
                    // Cek apakah bulan sudah dibayar
                    $exists = Pembayaran::where([
                        'nisn' => $request->nisn, 
                        'bulan_dibayar' => $bulan, 
                        'tahun_dibayar' => $request->tahun_dibayar
                    ])->exists();

                    if (!$exists) {
                        Pembayaran::create([
                            'id_petugas'    => $id_petugas,
                            'nisn'          => $request->nisn,
                            'tgl_bayar'     => $request->tgl_bayar,
                            'bulan_dibayar' => $bulan,
                            'tahun_dibayar' => $request->tahun_dibayar,
                            'id_spp'        => $request->id_spp,
                            'jumlah_bayar'  => $spp->nominal,
                        ]);
                        $bulanBerhasil++;
                    } else {
                        $bulanGagal[] = $bulan;
                    }
                }

                if ($bulanBerhasil > 0) {
                    $message = "Berhasil: $bulanBerhasil bulan disimpan.";
                    if (count($bulanGagal) > 0) {
                        $message .= " Sudah dibayar: " . implode(', ', $bulanGagal);
                    }
                    return redirect()->route('pembayaran.index')->with('success', $message);
                } else {
                    return back()->with('error', 'Semua bulan yang dipilih sudah dibayar!')->withInput();
                }
            } 
            
            // 3. FULL YEAR PAYMENT (12 Bulan Sekaligus)
            elseif ($tipeBayar === 'full_year') {
                $request->validate([
                    'bulan_full_year' => 'required|array|min:12',
                    'bulan_full_year.*' => 'required|string'
                ]);

                $bulanDibayar = $request->bulan_full_year;
                $jumlahBulan = count($bulanDibayar);
                $bulanBerhasil = 0;
                $bulanGagal = [];

                foreach ($bulanDibayar as $bulan) {
                    // Cek apakah bulan sudah dibayar
                    $exists = Pembayaran::where([
                        'nisn' => $request->nisn, 
                        'bulan_dibayar' => $bulan, 
                        'tahun_dibayar' => $request->tahun_dibayar
                    ])->exists();

                    if (!$exists) {
                        Pembayaran::create([
                            'id_petugas'    => $id_petugas,
                            'nisn'          => $request->nisn,
                            'tgl_bayar'     => $request->tgl_bayar,
                            'bulan_dibayar' => $bulan,
                            'tahun_dibayar' => $request->tahun_dibayar,
                            'id_spp'        => $request->id_spp,
                            'jumlah_bayar'  => $spp->nominal,
                        ]);
                        $bulanBerhasil++;
                    } else {
                        $bulanGagal[] = $bulan;
                    }
                }

                if ($bulanBerhasil === 12) {
                    return redirect()->route('pembayaran.index')
                        ->with('success', 'Pembayaran 1 tahun penuh (12 bulan) berhasil disimpan!');
                } elseif ($bulanBerhasil > 0) {
                    $message = "Berhasil: $bulanBerhasil bulan disimpan.";
                    if (count($bulanGagal) > 0) {
                        $message .= " Sudah dibayar: " . implode(', ', $bulanGagal);
                    }
                    return redirect()->route('pembayaran.index')->with('warning', $message);
                } else {
                    return back()->with('error', 'Semua bulan sudah dibayar!')->withInput();
                }
            }

            return back()->with('error', 'Tipe pembayaran tidak valid!')->withInput();
        });
    }

    /**
     * Menampilkan Detail Pembayaran (Show)
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Form Edit Pembayaran (Edit)
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $siswa = Siswa::all();
        $spp = Spp::all();
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'spp', 'bulan'));
    }

    /**
     * Proses Update Data (Update)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_bayar'     => 'required|date',
            'jumlah_bayar'  => 'required|integer|min:0',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->only(['tgl_bayar', 'jumlah_bayar']));

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui!');
    }

    /**
     * Hapus Data (Destroy)
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        
        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus!');
    }
}
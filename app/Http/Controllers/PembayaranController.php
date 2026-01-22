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
     * Proses Simpan (Store) - Mendukung Single & Multiple
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|exists:siswa,nisn',
            'tgl_bayar'     => 'required|date',
            'tahun_dibayar' => 'required|string|size:4',
            'id_spp'        => 'required|exists:spp,id_spp',
            'jumlah_bayar'  => 'required|integer|min:0',
            'tipe_bayar'    => 'required|in:single,multiple',
        ]);

        $id_petugas = session('petugas')->id_petugas;
        $tipeBayar  = $request->input('tipe_bayar');

        return DB::transaction(function () use ($request, $tipeBayar, $id_petugas) {
            if ($tipeBayar === 'single') {
                $request->validate(['bulan_dibayar_single' => 'required']);
                $bulan = $request->bulan_dibayar_single;

                if (Pembayaran::where(['nisn' => $request->nisn, 'bulan_dibayar' => $bulan, 'tahun_dibayar' => $request->tahun_dibayar])->exists()) {
                    return back()->with('error', "Bulan $bulan sudah dibayar!")->withInput();
                }

                Pembayaran::create([
                    'id_petugas' => $id_petugas,
                    'nisn' => $request->nisn,
                    'tgl_bayar' => $request->tgl_bayar,
                    'bulan_dibayar' => $bulan,
                    'tahun_dibayar' => $request->tahun_dibayar,
                    'id_spp' => $request->id_spp,
                    'jumlah_bayar' => $request->jumlah_bayar,
                ]);
            } else {
                $request->validate(['bulan_multiple' => 'required|array']);
                $spp = Spp::find($request->id_spp);
                foreach ($request->bulan_multiple as $bln) {
                    if (!Pembayaran::where(['nisn' => $request->nisn, 'bulan_dibayar' => $bln, 'tahun_dibayar' => $request->tahun_dibayar])->exists()) {
                        Pembayaran::create([
                            'id_petugas' => $id_petugas,
                            'nisn' => $request->nisn,
                            'tgl_bayar' => $request->tgl_bayar,
                            'bulan_dibayar' => $bln,
                            'tahun_dibayar' => $request->tahun_dibayar,
                            'id_spp' => $request->id_spp,
                            'jumlah_bayar' => $spp->nominal,
                        ]);
                    }
                }
            }
            return redirect()->route('pembayaran.index')->with('success', 'Transaksi Berhasil!');
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
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'spp', 'bulan'));
    }

    /**
     * Proses Update Data (Update)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_bayar'     => 'required|date',
            'jumlah_bayar'  => 'required|integer',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->only(['tgl_bayar', 'jumlah_bayar']));

        return redirect()->route('pembayaran.index')->with('success', 'Data diperbarui!');
    }

    /**
     * Hapus Data (Destroy)
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['siswa', 'petugas', 'spp']);

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_dibayar', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_dibayar', $request->tahun);
        }

        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->paginate(10);
        
        return view('pembayaran.index', compact('pembayaran'));
    }

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

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string|max:8',
            'tahun_dibayar' => 'required|string|size:4',
            'id_spp' => 'required|exists:spp,id_spp',
            'jumlah_bayar' => 'required|integer|min:0',
        ]);

        // Cek apakah sudah pernah bayar di bulan dan tahun yang sama
        $cekDuplikat = Pembayaran::where('nisn', $request->nisn)
                                 ->where('bulan_dibayar', $request->bulan_dibayar)
                                 ->where('tahun_dibayar', $request->tahun_dibayar)
                                 ->exists();

        if ($cekDuplikat) {
            return back()->with('error', 'Siswa sudah melakukan pembayaran untuk bulan ini!')->withInput();
        }

        Pembayaran::create([
            'id_petugas' => session('petugas')->id_petugas,
            'nisn' => $request->nisn,
            'tgl_bayar' => $request->tgl_bayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp' => $request->id_spp,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa.kelas', 'petugas', 'spp']);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::with(['kelas', 'spp'])->orderBy('nama')->get();
        $spp = Spp::orderBy('tahun', 'desc')->get();
        
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'spp', 'bulan'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string|max:8',
            'tahun_dibayar' => 'required|string|size:4',
            'id_spp' => 'required|exists:spp,id_spp',
            'jumlah_bayar' => 'required|integer|min:0',
        ]);

        // Cek duplikat kecuali data yang sedang diedit
        $cekDuplikat = Pembayaran::where('nisn', $request->nisn)
                                 ->where('bulan_dibayar', $request->bulan_dibayar)
                                 ->where('tahun_dibayar', $request->tahun_dibayar)
                                 ->where('id_pembayaran', '!=', $pembayaran->id_pembayaran)
                                 ->exists();

        if ($cekDuplikat) {
            return back()->with('error', 'Siswa sudah melakukan pembayaran untuk bulan ini!')->withInput();
        }

        $pembayaran->update([
            'nisn' => $request->nisn,
            'tgl_bayar' => $request->tgl_bayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp' => $request->id_spp,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus!');
    }

    // Method tambahan untuk get data siswa (AJAX)
    public function getSiswa($nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp'])
                     ->where('nisn', $nisn)
                     ->first();
        
        return response()->json($siswa);
    }
}
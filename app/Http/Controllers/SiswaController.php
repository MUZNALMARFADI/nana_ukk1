<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'spp']);
        
        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }
        
        $siswa = $query->orderBy('nama')->get();
        
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spp = Spp::orderBy('tahun', 'desc')->get();
        return view('siswa.create', compact('kelas', 'spp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:siswa,nisn',
            'nis' => 'required|string|size:8',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spp,id_spp',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['kelas', 'spp', 'pembayaran.petugas']);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spp = Spp::orderBy('tahun', 'desc')->get();
        return view('siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:siswa,nisn,' . $siswa->id,
            'nis' => 'required|string|size:8',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spp,id_spp',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diupdate!');
    }

    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
            return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Data Siswa tidak dapat dihapus karena masih ada pembayaran!');
        }
    }
}
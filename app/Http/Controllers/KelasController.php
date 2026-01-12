<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount('siswa')->orderBy('nama_kelas')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'kompetensi_keahlian' => 'required|string|max:50',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan!');
    }

    public function show(Kelas $kela)
    {
        $kela->load('siswa');
        return view('kelas.show', compact('kela'));
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'kompetensi_keahlian' => 'required|string|max:50',
        ]);

        $kela->update([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diupdate!');
    }

    public function destroy(Kelas $kela)
    {
        try {
            $kela->delete();
            return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Data Kelas tidak dapat dihapus karena masih ada siswa!');
        }
    }
}
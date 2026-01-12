<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::orderBy('nama_petugas')->get();
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:25|unique:petugas,username',
            'password' => 'required|string|min:6',
            'nama_petugas' => 'required|string|max:35',
            'level' => 'required|in:admin,petugas',
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Data Petugas berhasil ditambahkan!');
    }

    public function show(Petugas $petuga)
    {
        return view('petugas.show', compact('petuga'));
    }

    public function edit(Petugas $petuga)
    {
        return view('petugas.edit', compact('petuga'));
    }

    public function update(Request $request, Petugas $petuga)
    {
        $request->validate([
            'username' => 'required|string|max:25|unique:petugas,username,' . $petuga->id_petugas . ',id_petugas',
            'password' => 'nullable|string|min:6',
            'nama_petugas' => 'required|string|max:35',
            'level' => 'required|in:admin,petugas',
        ]);

        $data = [
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petuga->update($data);

        return redirect()->route('petugas.index')->with('success', 'Data Petugas berhasil diupdate!');
    }

    public function destroy(Petugas $petuga)
    {
        try {
            $petuga->delete();
            return redirect()->route('petugas.index')->with('success', 'Data Petugas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('petugas.index')->with('error', 'Data Petugas tidak dapat dihapus karena masih ada transaksi!');
        }
    }
}
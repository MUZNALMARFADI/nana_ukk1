<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::orderBy('tahun', 'desc')->get();
        return view('spp.index', compact('spp'));
    }

    public function create()
    {
        return view('spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4|unique:spp,tahun',
            'nominal' => 'required|integer|min:0',
        ]);

        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan!');
    }

    public function show(Spp $spp)
    {
        return view('spp.show', compact('spp'));
    }

    public function edit(Spp $spp)
    {
        return view('spp.edit', compact('spp'));
    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4|unique:spp,tahun,' . $spp->id_spp . ',id_spp',
            'nominal' => 'required|integer|min:0',
        ]);

        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diupdate!');
    }

    public function destroy(Spp $spp)
    {
        try {
            $spp->delete();
            return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('spp.index')->with('error', 'Data SPP tidak dapat dihapus karena masih digunakan!');
        }
    }
}
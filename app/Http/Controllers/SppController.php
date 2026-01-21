<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spp = Spp::orderBy('tahun', 'desc')->get();
        return view('spp.index', compact('spp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',  // HAPUS unique:spp,tahun
            'nominal' => 'required|integer|min:0',
        ], [
            // Custom error messages untuk tahun
            'tahun.required' => 'Tahun wajib diisi!',
            'tahun.integer' => 'Tahun harus berupa angka!',
            'tahun.digits' => 'Tahun harus 4 digit!',
            
            // Custom error messages untuk nominal
            'nominal.required' => 'Nominal wajib diisi!',
            'nominal.integer' => 'Nominal harus berupa angka!',
            'nominal.min' => 'Nominal tidak boleh kurang dari 0!',
        ]);

        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spp $spp)
    {
        return view('spp.show', compact('spp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spp $spp)
    {
        return view('spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',  // HAPUS unique:spp,tahun,...
            'nominal' => 'required|integer|min:0',
        ], [
            // Custom error messages untuk tahun
            'tahun.required' => 'Tahun wajib diisi!',
            'tahun.integer' => 'Tahun harus berupa angka!',
            'tahun.digits' => 'Tahun harus 4 digit!',
            
            // Custom error messages untuk nominal
            'nominal.required' => 'Nominal wajib diisi!',
            'nominal.integer' => 'Nominal harus berupa angka!',
            'nominal.min' => 'Nominal tidak boleh kurang dari 0!',
        ]);

        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
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
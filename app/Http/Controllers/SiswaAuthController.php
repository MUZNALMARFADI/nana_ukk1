<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaAuthController extends Controller
{
    // Tampilkan form login siswa
    public function showLoginForm()
    {
        if (session()->has('siswa')) {
            return redirect()->route('siswa.dashboard');
        }
        return view('auth.login-siswa');
    }

    // Proses login siswa
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required|size:10',
            'nis' => 'required|size:8'
        ], [
            'nisn.required' => 'NISN wajib diisi',
            'nisn.size' => 'NISN harus 10 digit',
            'nis.required' => 'NIS wajib diisi',
            'nis.size' => 'NIS harus 8 digit'
        ]);

        // Cari siswa berdasarkan NISN dan NIS
        $siswa = Siswa::where('nisn', $request->nisn)
                      ->where('nis', $request->nis)
                      ->with(['kelas', 'spp'])
                      ->first();

        // Cek apakah siswa ditemukan
        if ($siswa) {
            // Simpan data siswa ke session
            session(['siswa' => $siswa]);
            
            return redirect()->route('siswa.dashboard')
                           ->with('success', 'Login berhasil! Selamat datang ' . $siswa->nama);
        }

        return back()->with('error', 'NISN atau NIS tidak ditemukan!')->withInput();
    }

    // Proses logout siswa - REDIRECT KE LANDING PAGE
    public function logout(Request $request)
    {
        Session::forget('siswa');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // REDIRECT KE LANDING PAGE (root URL)
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
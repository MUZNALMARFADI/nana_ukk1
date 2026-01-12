<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PetugasAuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        if (session()->has('petugas')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login-petugas');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        // Cari petugas berdasarkan username
        $petugas = Petugas::where('username', $request->username)->first();

        // Cek apakah petugas ditemukan dan password cocok
        if ($petugas && Hash::check($request->password, $petugas->password)) {
            // Simpan data petugas ke session
            session(['petugas' => $petugas]);
            
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang ' . $petugas->nama_petugas);
        }

        return back()->with('error', 'Username atau password salah!')->withInput();
    }

    // Proses logout
    public function logout(Request $request)
    {
        Session::forget('petugas');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login.form')->with('success', 'Logout berhasil!');
    }
}
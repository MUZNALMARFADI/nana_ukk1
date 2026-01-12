<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PetugasAuthController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome-page');
});

// ============ PETUGAS LOGIN ROUTES ============
Route::get('/login', [PetugasAuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [PetugasAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

// ============ SISWA LOGIN ROUTES ============
Route::get('/siswa/login', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login.form');
Route::post('/siswa/login', [SiswaAuthController::class, 'login'])->name('siswa.login.submit');
Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

// ============ SISWA DASHBOARD ROUTES (Protected) ============
Route::middleware(['siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [SiswaDashboardController::class, 'historyPembayaran'])->name('history');
});

// ============ PETUGAS & ADMIN ROUTES (Protected) ============
Route::middleware(['petugas'])->group(function () {
    // Dashboard - Admin dan Petugas
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // View Only untuk Petugas - Index dan Show saja
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{kela}', [KelasController::class, 'show'])->name('kelas.show');
    
    Route::get('/spp', [SppController::class, 'index'])->name('spp.index');
    Route::get('/spp/{spp}', [SppController::class, 'show'])->name('spp.show');

    // Pembayaran - Admin dan Petugas bisa entri transaksi
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran-siswa/{nisn}', [PembayaranController::class, 'getSiswa'])->name('pembayaran.getSiswa');
});

// ============ ADMIN ONLY ROUTES ============
Route::middleware(['admin'])->group(function () {
    // CRUD Siswa - Hanya Admin
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    
    // CRUD Kelas - Hanya Admin
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{kela}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kela}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kela}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    
    // CRUD SPP - Hanya Admin
    Route::get('/spp/create', [SppController::class, 'create'])->name('spp.create');
    Route::post('/spp', [SppController::class, 'store'])->name('spp.store');
    Route::get('/spp/{spp}/edit', [SppController::class, 'edit'])->name('spp.edit');
    Route::put('/spp/{spp}', [SppController::class, 'update'])->name('spp.update');
    Route::delete('/spp/{spp}', [SppController::class, 'destroy'])->name('spp.destroy');
    
    // CRUD Petugas - Hanya Admin
    Route::resource('petugas', PetugasController::class);
    
    // Laporan - Hanya Admin
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/pembayaran', [LaporanController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/tunggakan', [LaporanController::class, 'tunggakan'])->name('tunggakan');
        Route::get('/per-kelas', [LaporanController::class, 'perKelas'])->name('per-kelas');
    });
});
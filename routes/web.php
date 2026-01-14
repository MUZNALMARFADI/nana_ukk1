<?php

use Illuminate\Support\Facades\Route;
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

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================== LANDING PAGE ==================
Route::get('/', function () {
    return view('welcome-page');
});

// ================== AUTH PETUGAS ==================
Route::get('/login', [PetugasAuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [PetugasAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

// ================== AUTH SISWA ==================
Route::get('/siswa/login', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login.form');
Route::post('/siswa/login', [SiswaAuthController::class, 'login'])->name('siswa.login.submit');
Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

// ================== SISWA AREA ==================
Route::middleware('siswa')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [SiswaDashboardController::class, 'historyPembayaran'])->name('history');
});

// ================== PETUGAS AREA ==================
Route::middleware('petugas')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Siswa (VIEW ONLY)
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');

    // Kelas (VIEW ONLY)
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');

    // SPP (VIEW ONLY)
    Route::get('/spp', [SppController::class, 'index'])->name('spp.index');
    Route::get('/spp/{spp}', [SppController::class, 'show'])->name('spp.show');

    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/pembayaran-siswa/{nisn}', [PembayaranController::class, 'getSiswa'])
        ->name('pembayaran.getSiswa');
});

// ================== ADMIN AREA ==================
Route::middleware('admin')->group(function () {

    // CRUD SISWA
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // CRUD KELAS
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // CRUD SPP
    Route::get('/spp/create', [SppController::class, 'create'])->name('spp.create');
    Route::post('/spp', [SppController::class, 'store'])->name('spp.store');
    Route::get('/spp/{spp}/edit', [SppController::class, 'edit'])->name('spp.edit');
    Route::put('/spp/{spp}', [SppController::class, 'update'])->name('spp.update');
    Route::delete('/spp/{spp}', [SppController::class, 'destroy'])->name('spp.destroy');

    // CRUD PETUGAS
    Route::resource('petugas', PetugasController::class);

    // LAPORAN
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/pembayaran', [LaporanController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/tunggakan', [LaporanController::class, 'tunggakan'])->name('tunggakan');
        Route::get('/per-kelas', [LaporanController::class, 'perKelas'])->name('per-kelas');
    });
});

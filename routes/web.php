<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicPengaduanController;

// Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\DokumentasiController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\WargaController;

// Controller Warga
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\PengaduanController as WargaPengaduanController;

// ==========================================
// ROUTE HALAMAN DEPAN (PUBLIC)
// ==========================================
Route::get('/', [PublicController::class, 'index'])
    ->name('home');

Route::post('/pengaduan', [PublicPengaduanController::class, 'store'])
    ->name('pengaduan.store');


// ==========================================
// ROUTE LOGIN WARGA
// ==========================================
Route::get('/login-warga', [LoginController::class, 'showLoginWarga'])
    ->name('login.warga');

Route::post('/login-warga', [LoginController::class, 'loginWarga'])
    ->name('login.warga.process');


// ==========================================
// ROUTE AUTHENTICATION (ADMIN & UMUM)
// ==========================================
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login'); // Khusus Admin

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ==========================================
// ROUTE DASHBOARD & PENGADUAN WARGA (Setelah Login Warga)
// ==========================================
Route::middleware(['auth'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');

    // Fitur Pengaduan Warga
    Route::get('/pengaduan', [WargaPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [WargaPengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [WargaPengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}/edit', [WargaPengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [WargaPengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{pengaduan}', [WargaPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});


// ==========================================
// ROUTE PANEL ADMIN
// ==========================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Fitur Kelola Warga oleh Admin (Lengkap dengan Edit & Delete)
        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

        Route::resource('/pengumuman', PengumumanController::class);

        Route::resource('/kegiatan', KegiatanController::class);

        Route::resource('/pengurus', PengurusController::class)
            ->parameters([
                'pengurus' => 'pengurus'
            ]);

        Route::resource('/dokumentasi', DokumentasiController::class)
            ->parameters([
                'dokumentasi' => 'dokumentasi'
            ]);

        Route::resource('/pengaduan', PengaduanController::class)
            ->parameters([
                'pengaduan' => 'pengaduan'
            ]);

        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
    });
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicPengaduanController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\DokumentasiController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', [PublicController::class, 'index'])
    ->name('home');

Route::post('/pengaduan', [PublicPengaduanController::class, 'store'])
    ->name('pengaduan.store');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

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
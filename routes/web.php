<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LabaRugiController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('kategori', KategoriController::class);

    Route::resource('barang', BarangController::class);

    Route::resource('transaksi', TransaksiController::class);

    Route::get('/riwayat',
        [TransaksiController::class, 'riwayat']
    )->name('riwayat.index');

    Route::get('/transaksi/{id}/cetak',
        [TransaksiController::class, 'cetak']
    )->name('transaksi.cetak');

    Route::get('/laporan',
        [LaporanController::class, 'index']
    )->name('laporan.index');

    Route::get('/laporan/export',
        [LaporanController::class, 'export']
    )->name('laporan.export');

    Route::get('/laporan-laba',
        [LabaRugiController::class, 'index']
    )->name('laba.index');

    Route::post('/logout',
        [AuthController::class, 'logout']
    )->name('logout');

});
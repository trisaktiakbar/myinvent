<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GudangCentralController;
use App\Http\Controllers\GudangPusatController;
use App\Http\Controllers\GudangSiteController;
use App\Http\Controllers\PermintaanBarangController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/beranda', function () {
    return view('beranda.index');
})->middleware(['auth', 'verified'])->name('beranda');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/permintaan-barang', [PermintaanBarangController::class, 'index'])->name('permintaan-barang.index');
        Route::get('/permintaan-barang/tambah', [PermintaanBarangController::class, 'create'])->name('permintaan-barang.create');
        Route::post('/permintaan-barang/tambah', [PermintaanBarangController::class, 'store'])->name('permintaan-barang.store');
        Route::get('/permintaan-barang/edit/{slug}', [PermintaanBarangController::class, 'edit'])->name('permintaan-barang.edit');
        Route::put('/permintaan-barang/edit/{slug}', [PermintaanBarangController::class, 'update'])->name('permintaan-barang.update');
        Route::delete('/permintaan-barang/hapus/{slug}', [PermintaanBarangController::class, 'destroy'])->name('permintaan-barang.destroy');
    });

    Route::middleware('gudangPusat')->group(function () {
        Route::get('/gudang-pusat', [GudangPusatController::class, 'index'])->name('gudang-pusat.index');
        Route::put('/gudang-pusat/confirm/{slug}', [GudangPusatController::class, 'confirm'])->name('gudang-pusat.confirm');
        Route::put('/gudang-pusat/abort/{slug}', [GudangPusatController::class, 'abort'])->name('gudang-pusat.abort');
    });

    Route::middleware('gudangCentral')->group(function () {
        Route::get('/gudang-central', [GudangCentralController::class, 'index'])->name('gudang-central.index');
        Route::put('/gudang-central/confirm/{slug}', [GudangCentralController::class, 'confirm'])->name('gudang-central.confirm');
        Route::put('/gudang-central/abort/{slug}', [GudangCentralController::class, 'abort'])->name('gudang-central.abort');
    });

    Route::middleware('gudangSite')->group(function () {
        Route::get('/gudang-site', [GudangSiteController::class, 'index'])->name('gudang-site.index');
        Route::put('/gudang-site/confirm/{slug}', [GudangSiteController::class, 'confirm'])->name('gudang-site.confirm');
        Route::put('/gudang-site/abort/{slug}', [GudangSiteController::class, 'abort'])->name('gudang-site.abort');
    });
});



require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GudangSiteController;
use App\Http\Controllers\KelolaItemController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\GudangPusatController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\GudangCentralController;
use App\Http\Controllers\TimePlannerHOController;
use App\Http\Controllers\ExportByLokasiController;
use App\Http\Controllers\ExportByKodeItemController;
use App\Http\Controllers\PermintaanBarangController;
use App\Http\Controllers\ManajemenPenggunaUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ManajemenPenggunaGudangSiteController;
use App\Http\Controllers\ManajemenPenggunaGudangPusatController;
use App\Http\Controllers\ManajemenPenggunaGudangCentralController;
use App\Http\Controllers\ManajemenPenggunaPermintaanBarangController;
use App\Http\Controllers\ManajemenPenggunaPurchasingController;
use App\Http\Controllers\ManajemenPenggunaTimePlannerHOController;
use App\Http\Controllers\PembelianLokalController;

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

    Route::get('/pengaturan/profil', [ProfilController::class, 'index'])->name('pengaturan.profil.index');
    Route::put('/pengaturan/profil', [ProfilController::class, 'update'])->name('pengaturan.profil.update');

    Route::get('/pengaturan/ganti-password', [GantiPasswordController::class, 'index'])->name('pengaturan.ganti-password.index');
    Route::put('/pengaturan/ganti-password', [GantiPasswordController::class, 'update'])->name('pengaturan.ganti-password.update');

    Route::middleware('admin')->group(function () {

        Route::get('/manajemen-pengguna/permintaan-barang', [ManajemenPenggunaPermintaanBarangController::class, 'index'])->name('manajemen-pengguna.permintaan-barang.index');
        Route::get('/manajemen-pengguna/permintaan-barang/tambah', [ManajemenPenggunaPermintaanBarangController::class, 'create'])->name('manajemen-pengguna.permintaan-barang.create');
        Route::post('/manajemen-pengguna/permintaan-barang/tambah', [ManajemenPenggunaPermintaanBarangController::class, 'store'])->name('manajemen-pengguna.permintaan-barang.store');
        Route::get('/manajemen-pengguna/permintaan-barang/edit/{username}', [ManajemenPenggunaPermintaanBarangController::class, 'edit'])->name('manajemen-pengguna.permintaan-barang.edit');
        Route::put('/manajemen-pengguna/permintaan-barang/edit/{username}', [ManajemenPenggunaPermintaanBarangController::class, 'update'])->name('manajemen-pengguna.permintaan-barang.update');
        Route::put('/manajemen-pengguna/permintaan-barang/edit/{username}/reset-password', [ManajemenPenggunaPermintaanBarangController::class, 'resetPassword'])->name('manajemen-pengguna.permintaan-barang.reset-password');
        Route::delete('/manajemen-pengguna/permintaan-barang/{username}', [ManajemenPenggunaPermintaanBarangController::class, 'destroy'])->name('manajemen-pengguna.permintaan-barang.destroy');

        Route::get('/manajemen-pengguna/time-planner-ho', [ManajemenPenggunaTimePlannerHOController::class, 'index'])->name('manajemen-pengguna.time-planner-ho.index');
        Route::get('/manajemen-pengguna/time-planner-ho/tambah', [ManajemenPenggunaTimePlannerHOController::class, 'create'])->name('manajemen-pengguna.time-planner-ho.create');
        Route::post('/manajemen-pengguna/time-planner-ho/tambah', [ManajemenPenggunaTimePlannerHOController::class, 'store'])->name('manajemen-pengguna.time-planner-ho.store');
        Route::get('/manajemen-pengguna/time-planner-ho/edit/{username}', [ManajemenPenggunaTimePlannerHOController::class, 'edit'])->name('manajemen-pengguna.time-planner-ho.edit');
        Route::put('/manajemen-pengguna/time-planner-ho/edit/{username}', [ManajemenPenggunaTimePlannerHOController::class, 'update'])->name('manajemen-pengguna.time-planner-ho.update');
        Route::put('/manajemen-pengguna/time-planner-ho/edit/{username}/reset-password', [ManajemenPenggunaTimePlannerHOController::class, 'resetPassword'])->name('manajemen-pengguna.time-planner-ho.reset-password');
        Route::delete('/manajemen-pengguna/time-planner-ho/{username}', [ManajemenPenggunaTimePlannerHOController::class, 'destroy'])->name('manajemen-pengguna.time-planner-ho.destroy');

        Route::get('/manajemen-pengguna/purchasing', [ManajemenPenggunaPurchasingController::class, 'index'])->name('manajemen-pengguna.purchasing.index');
        Route::get('/manajemen-pengguna/purchasing/tambah', [ManajemenPenggunaPurchasingController::class, 'create'])->name('manajemen-pengguna.purchasing.create');
        Route::post('/manajemen-pengguna/purchasing/tambah', [ManajemenPenggunaPurchasingController::class, 'store'])->name('manajemen-pengguna.purchasing.store');
        Route::get('/manajemen-pengguna/purchasing/edit/{username}', [ManajemenPenggunaPurchasingController::class, 'edit'])->name('manajemen-pengguna.purchasing.edit');
        Route::put('/manajemen-pengguna/purchasing/edit/{username}', [ManajemenPenggunaPurchasingController::class, 'update'])->name('manajemen-pengguna.purchasing.update');
        Route::put('/manajemen-pengguna/purchasing/edit/{username}/reset-password', [ManajemenPenggunaPurchasingController::class, 'resetPassword'])->name('manajemen-pengguna.purchasing.reset-password');
        Route::delete('/manajemen-pengguna/purchasing/{username}', [ManajemenPenggunaPurchasingController::class, 'destroy'])->name('manajemen-pengguna.purchasing.destroy');



        Route::get('/manajemen-pengguna/gudang-pusat', [ManajemenPenggunaGudangPusatController::class, 'index'])->name('manajemen-pengguna.gudang-pusat.index');
        Route::get('/manajemen-pengguna/gudang-pusat/tambah', [ManajemenPenggunaGudangPusatController::class, 'create'])->name('manajemen-pengguna.gudang-pusat.create');
        Route::post('/manajemen-pengguna/gudang-pusat/tambah', [ManajemenPenggunaGudangPusatController::class, 'store'])->name('manajemen-pengguna.gudang-pusat.store');
        Route::get('/manajemen-pengguna/gudang-pusat/edit/{username}', [ManajemenPenggunaGudangPusatController::class, 'edit'])->name('manajemen-pengguna.gudang-pusat.edit');
        Route::put('/manajemen-pengguna/gudang-pusat/edit/{username}', [ManajemenPenggunaGudangPusatController::class, 'update'])->name('manajemen-pengguna.gudang-pusat.update');
        Route::put('/manajemen-pengguna/gudang-pusat/edit/{username}/reset-password', [ManajemenPenggunaGudangPusatController::class, 'resetPassword'])->name('manajemen-pengguna.gudang-pusat.reset-password');
        Route::delete('/manajemen-pengguna/gudang-pusat/{username}', [ManajemenPenggunaGudangPusatController::class, 'destroy'])->name('manajemen-pengguna.gudang-pusat.destroy');

        Route::get('/manajemen-pengguna/gudang-central', [ManajemenPenggunaGudangCentralController::class, 'index'])->name('manajemen-pengguna.gudang-central.index');
        Route::get('/manajemen-pengguna/gudang-central/tambah', [ManajemenPenggunaGudangCentralController::class, 'create'])->name('manajemen-pengguna.gudang-central.create');
        Route::post('/manajemen-pengguna/gudang-central/tambah', [ManajemenPenggunaGudangCentralController::class, 'store'])->name('manajemen-pengguna.gudang-central.store');
        Route::get('/manajemen-pengguna/gudang-central/edit/{username}', [ManajemenPenggunaGudangCentralController::class, 'edit'])->name('manajemen-pengguna.gudang-central.edit');
        Route::put('/manajemen-pengguna/gudang-central/edit/{username}', [ManajemenPenggunaGudangCentralController::class, 'update'])->name('manajemen-pengguna.gudang-central.update');
        Route::put('/manajemen-pengguna/gudang-central/edit/{username}/reset-password', [ManajemenPenggunaGudangCentralController::class, 'resetPassword'])->name('manajemen-pengguna.gudang-central.reset-password');
        Route::delete('/manajemen-pengguna/gudang-central/{username}', [ManajemenPenggunaGudangCentralController::class, 'destroy'])->name('manajemen-pengguna.gudang-central.destroy');

        Route::get('/manajemen-pengguna/gudang-site', [ManajemenPenggunaGudangSiteController::class, 'index'])->name('manajemen-pengguna.gudang-site.index');
        Route::get('/manajemen-pengguna/gudang-site/tambah', [ManajemenPenggunaGudangSiteController::class, 'create'])->name('manajemen-pengguna.gudang-site.create');
        Route::post('/manajemen-pengguna/gudang-site/tambah', [ManajemenPenggunaGudangSiteController::class, 'store'])->name('manajemen-pengguna.gudang-site.store');
        Route::get('/manajemen-pengguna/gudang-site/edit/{username}', [ManajemenPenggunaGudangSiteController::class, 'edit'])->name('manajemen-pengguna.gudang-site.edit');
        Route::put('/manajemen-pengguna/gudang-site/edit/{username}', [ManajemenPenggunaGudangSiteController::class, 'update'])->name('manajemen-pengguna.gudang-site.update');
        Route::put('/manajemen-pengguna/gudang-site/edit/{username}/reset-password', [ManajemenPenggunaGudangSiteController::class, 'resetPassword'])->name('manajemen-pengguna.gudang-site.reset-password');
        Route::delete('/manajemen-pengguna/gudang-site/{username}', [ManajemenPenggunaGudangSiteController::class, 'destroy'])->name('manajemen-pengguna.gudang-site.destroy');

        Route::get('/manajemen-pengguna/user', [ManajemenPenggunaUserController::class, 'index'])->name('manajemen-pengguna.user.index');
        Route::get('/manajemen-pengguna/user/tambah', [ManajemenPenggunaUserController::class, 'create'])->name('manajemen-pengguna.user.create');
        Route::post('/manajemen-pengguna/user/tambah', [ManajemenPenggunaUserController::class, 'store'])->name('manajemen-pengguna.user.store');
        Route::get('/manajemen-pengguna/user/edit/{username}', [ManajemenPenggunaUserController::class, 'edit'])->name('manajemen-pengguna.user.edit');
        Route::put('/manajemen-pengguna/user/edit/{username}', [ManajemenPenggunaUserController::class, 'update'])->name('manajemen-pengguna.user.update');
        Route::put('/manajemen-pengguna/user/edit/{username}/reset-password', [ManajemenPenggunaUserController::class, 'resetPassword'])->name('manajemen-pengguna.user.reset-password');
        Route::delete('/manajemen-pengguna/user/{username}', [ManajemenPenggunaUserController::class, 'destroy'])->name('manajemen-pengguna.user.destroy');
    });

    Route::middleware('user')->group(function () {
        Route::get('/export-by-kode-item', [ExportByKodeItemController::class, 'index'])->name('export-by-kode-item.index');
        Route::get('/export-by-kode-item/show/{slug}', [ExportByKodeItemController::class, 'show'])->name('export-by-kode-item.show');
        Route::post('/export-by-kode-item/show/{slug}/export', [ExportByKodeItemController::class, 'export'])->name('export-by-kode-item.export');

        Route::get('/export-by-lokasi', [ExportByLokasiController::class, 'index'])->name('export-by-lokasi.index');
        Route::get('/export-by-lokasi/show/{lokasi}', [ExportByLokasiController::class, 'show'])->name('export-by-lokasi.show');
        Route::post('/export-by-lokasi/show/{slug}/export', [ExportByLokasiController::class, 'export'])->name('export-by-lokasi.export');
    });

    Route::middleware('permintaanBarang')->group(function () {
        Route::get('/kelola-item', [KelolaItemController::class, 'index'])->name('kelola-item.index');
        Route::get('/kelola-item/tambah', [KelolaItemController::class, 'create'])->name('kelola-item.create');
        Route::post('/kelola-item/tambah', [KelolaItemController::class, 'store'])->name('kelola-item.store');
        Route::get('/kelola-item/edit/{slug}', [KelolaItemController::class, 'edit'])->name('kelola-item.edit');
        Route::put('/kelola-item/edit/{slug}', [KelolaItemController::class, 'update'])->name('kelola-item.update');
        Route::delete('/kelola-item/hapus/{slug}', [KelolaItemController::class, 'destroy'])->name('kelola-item.destroy');

        Route::get('/permintaan-barang', [PermintaanBarangController::class, 'index'])->name('permintaan-barang.index');
        Route::get('/permintaan-barang/tambah', [PermintaanBarangController::class, 'create'])->name('permintaan-barang.create');
        Route::post('/permintaan-barang/tambah', [PermintaanBarangController::class, 'store'])->name('permintaan-barang.store');
        Route::get('/permintaan-barang/edit/{slug}', [PermintaanBarangController::class, 'edit'])->name('permintaan-barang.edit');
        Route::put('/permintaan-barang/edit/{slug}', [PermintaanBarangController::class, 'update'])->name('permintaan-barang.update');
        Route::delete('/permintaan-barang/hapus/{slug}', [PermintaanBarangController::class, 'destroy'])->name('permintaan-barang.destroy');
    });

    Route::middleware('timePlannerHO')->group(function () {
        Route::get('/time-planner-ho', [TimePlannerHOController::class, 'index'])->name('time-planner-ho.index');
        Route::put('/time-planner-ho/confirm/{slug}', [TimePlannerHOController::class, 'confirm'])->name('time-planner-ho.confirm');
        Route::put('/time-planner-ho/abort/{slug}', [TimePlannerHOController::class, 'abort'])->name('time-planner-ho.abort');
    });

    Route::middleware('purchasing')->group(function () {
        Route::get('/purchasing', [PurchasingController::class, 'index'])->name('purchasing.index');
        Route::put('/purchasing/confirm/{slug}', [PurchasingController::class, 'confirm'])->name('purchasing.confirm');
        Route::put('/purchasing/abort/{slug}', [PurchasingController::class, 'abort'])->name('purchasing.abort');
    });

    Route::middleware('gudangPusat')->group(function () {
        Route::get('/gudang-pusat', [GudangPusatController::class, 'index'])->name('gudang-pusat.index');
        Route::put('/gudang-pusat/confirm/{slug}', [GudangPusatController::class, 'confirm'])->name('gudang-pusat.confirm');
        Route::put('/gudang-pusat/abort/{slug}', [GudangPusatController::class, 'abort'])->name('gudang-pusat.abort');
        Route::put('/gudang-pusat/deliver/{slug}', [GudangPusatController::class, 'deliver'])->name('gudang-pusat.deliver');
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

        Route::get('/pembelian-lokal', [PembelianLokalController::class, 'index'])->name('pembelian-lokal.index');
        Route::get('/pembelian-lokal/tambah', [PembelianLokalController::class, 'create'])->name('pembelian-lokal.create');
        Route::post('/pembelian-lokal/tambah', [PembelianLokalController::class, 'store'])->name('pembelian-lokal.store');
        Route::get('/pembelian-lokal/edit/{slug}', [PembelianLokalController::class, 'edit'])->name('pembelian-lokal.edit');
        Route::put('/pembelian-lokal/edit/{slug}', [PembelianLokalController::class, 'update'])->name('pembelian-lokal.update');
        Route::delete('/pembelian-lokal/hapus/{slug}', [PembelianLokalController::class, 'destroy'])->name('pembelian-lokal.destroy');
    });
});



require __DIR__ . '/auth.php';

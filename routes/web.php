<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformasiKosController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\PenghuniController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Penghuni\DashboardPenghuniController;
use App\Http\Controllers\Penghuni\PembayaranPenghuniController;
use App\Http\Controllers\Penghuni\ProfilePenghuniController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard',
    [RedirectController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | KAMAR
        |--------------------------------------------------------------------------
        */

        Route::resource('kamar', KamarController::class);

        /*
        |--------------------------------------------------------------------------
        | PENGHUNI
        |--------------------------------------------------------------------------
        */

        Route::resource('penghuni', PenghuniController::class);

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        Route::get('/pembayaran',
            [PembayaranController::class, 'index']
        )->name('pembayaran.index');

        Route::get('/pembayaran/{id}',
            [PembayaranController::class, 'show']
        )->name('pembayaran.show');

        Route::post('/pembayaran/{id}/verifikasi',
            [PembayaranController::class, 'verifikasi']
        )->name('pembayaran.verifikasi');

        Route::post('/pembayaran/{id}/tolak',
            [PembayaranController::class, 'tolak']
        )->name('pembayaran.tolak');

        /*
        |--------------------------------------------------------------------------
        | INFORMASI KOS
        |--------------------------------------------------------------------------
        */

        Route::get('/informasi',
            [InformasiKosController::class, 'index']
        )->name('informasi.index');

        Route::get('/informasi/create',
            [InformasiKosController::class, 'create']
        )->name('informasi.create');

        Route::post('/informasi',
            [InformasiKosController::class, 'store']
        )->name('informasi.store');

        Route::get('/informasi/edit',
            [InformasiKosController::class, 'edit']
        )->name('informasi.edit');

        Route::put('/informasi',
            [InformasiKosController::class, 'update']
        )->name('informasi.update');

        Route::post('/informasi/hapus-foto',
            [InformasiKosController::class, 'hapusFoto']
        )->name('informasi.hapusFoto');

        /*
        |--------------------------------------------------------------------------
        | PLACEHOLDER
        |--------------------------------------------------------------------------
        */

        Route::view('/aduan', 'admin.aduan.index')
            ->name('aduan.index');

        Route::view('/aturan', 'admin.aturan.index')
            ->name('aturan.index');

});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:super_admin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/',
            [SuperAdminController::class, 'index']
        )->name('dashboard');

        Route::get('/pengajuan',
            [SuperAdminController::class, 'pengajuan']
        )->name('pengajuan');

        Route::get('/pengajuan/{id}',
            [SuperAdminController::class, 'detail']
        )->name('pengajuan.detail');

        Route::get('/riwayat',
            [SuperAdminController::class, 'riwayat']
        )->name('riwayat');

        Route::get('/admin',
            [SuperAdminController::class, 'adminList']
        )->name('admin');

        Route::post('/approve/{id}',
            [SuperAdminController::class, 'approve']
        )->name('approve');

        Route::post('/reject/{id}',
            [SuperAdminController::class, 'reject']
        )->name('reject');

        Route::delete('/riwayat/{id}',
            [SuperAdminController::class, 'hapusRiwayat']
        )->name('riwayat.hapus');

        Route::delete('/admin/{id}',
            [SuperAdminController::class, 'hapusAdmin']
        )->name('admin.hapus');

});

Route::middleware(['auth', 'role:penghuni'])
    ->prefix('penghuni')
    ->name('penghuni.')
    ->group(function () {

        // =========================
        // DASHBOARD
        // =========================

        Route::get(
            '/dashboard',
            [DashboardPenghuniController::class, 'index']
        )->name('dashboard');

        // =========================
        // PEMBAYARAN
        // =========================

        Route::get(
            '/pembayaran',
            [PembayaranPenghuniController::class, 'index']
        )->name('pembayaran.index');

        Route::get(
            '/pembayaran/create',
            [PembayaranPenghuniController::class, 'create']
        )->name('pembayaran.create');

        Route::post(
            '/pembayaran/store',
            [PembayaranPenghuniController::class, 'store']
        )->name('pembayaran.store');

        // =========================
// PROFIL
// =========================

Route::get(
    '/profil',
    [ProfilePenghuniController::class, 'index']
)->name('profil.index');

Route::put(
    '/profil/update',
    [ProfilePenghuniController::class, 'update']
)->name('profil.update');

Route::get(
    '/profil/edit',
    [ProfilePenghuniController::class, 'edit']
)->name('profil.edit');

});


/*
|--------------------------------------------------------------------------
| KATALOG
|--------------------------------------------------------------------------
*/

Route::get('/hubungi', function () {
    return view('katalog.hubungi');
})->name('hubungi');

Route::get('/tentang', function () {
    return view('katalog.tentang');
})->name('tentang');

Route::get('/katalog/{id}',
    [HomeController::class, 'detail']
)->name('katalog.detail');

Route::get('/katalog/{kosId}/kamar/{kamarId}',
    [HomeController::class, 'detailKamar']
)->name('katalog.kamar.detail');

require __DIR__.'/auth.php';

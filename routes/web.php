<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard redirect berdasarkan role
Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kamar
    Route::resource('kamar', \App\Http\Controllers\Admin\KamarController::class);

    // Penghuni
    Route::resource('penghuni', \App\Http\Controllers\Admin\PenghuniController::class);

    // Placeholder routes (nanti diisi)
    Route::get('/pembayaran', fn() => view('admin.pembayaran.index'))->name('pembayaran.index');
    Route::get('/aduan', fn() => view('admin.aduan.index'))->name('aduan.index');
    Route::get('/aturan', fn() => view('admin.aturan.index'))->name('aturan.index');
    Route::get('/informasi', fn() => view('admin.informasi.index'))->name('informasi.index');
});

// Super Admin
Route::middleware(['auth'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('dashboard');
    Route::get('/pengajuan', [SuperAdminController::class, 'pengajuan'])->name('pengajuan');
    Route::get('/pengajuan/{id}', [SuperAdminController::class, 'detail'])->name('pengajuan.detail');
    Route::get('/riwayat', [SuperAdminController::class, 'riwayat'])->name('riwayat');
    Route::get('/admin', [SuperAdminController::class, 'adminList'])->name('admin');
    Route::post('/approve/{id}', [SuperAdminController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [SuperAdminController::class, 'reject'])->name('reject');
    Route::delete('/riwayat/{id}', [SuperAdminController::class, 'hapusRiwayat'])->name('riwayat.hapus');
    Route::delete('/admin/{id}', [SuperAdminController::class, 'hapusAdmin'])->name('admin.hapus');
});

Route::get('/home', function () {
    return view('katalog.home');
})->name('home');

Route::get('/hubungi', function () {
    return view('katalog.hubungi');
})->name('hubungi');

Route::get('/tentang', function () {
    return view('katalog.tentang');
})->name('tentang');


require __DIR__.'/auth.php';
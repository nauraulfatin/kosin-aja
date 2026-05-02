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
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

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
});



// punya sapir


Route::get('/penghuni/dashboard', function () {
    return view('penghuni.dashboard');
})->name('penghuni.dashboard');

Route::get('/penghuni/pembayaran', function () {
    return view('penghuni.pembayaran');
})->name('penghuni.pembayaran');

Route::get('/penghuni/aduan', function () {
    return view('penghuni.aduan');
})->name('penghuni.aduan');

Route::get('/penghuni/aturan', function () {
    return view('penghuni.aturan');
})->name('penghuni.aturan');

Route::get('/penghuni/profil', function () {
    return view('penghuni.profil');
})->name('penghuni.profil');


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
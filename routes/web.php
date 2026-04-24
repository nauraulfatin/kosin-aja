<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/superadmin', [SuperAdminController::class, 'index']);

    Route::post('/approve/{id}', [SuperAdminController::class, 'approve']);

    Route::post('/reject/{id}', [SuperAdminController::class, 'reject']);

});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

require __DIR__.'/auth.php';

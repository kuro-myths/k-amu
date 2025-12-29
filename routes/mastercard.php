<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mastercard\DashboardController;
use App\Http\Controllers\Mastercard\UserManagementController;
use App\Http\Controllers\Mastercard\ChatController;
use App\Http\Controllers\Mastercard\ProfileController;
use App\Http\Controllers\Mastercard\ActivityController;

Route::middleware(['auth', 'role:mastercard'])->prefix('mastercard')->name('mastercard.')->group(function () {
    // Dashboard
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');

    // User Management
    Route::get('/pengguna', [UserManagementController::class, 'pengguna'])->name('pengguna');
    Route::get('/akun', [UserManagementController::class, 'akun'])->name('akun');
    Route::post('/akun', [UserManagementController::class, 'createAkun'])->name('akun.create');

    // Chat
    Route::get('/obrolan', [ChatController::class, 'index'])->name('obrolan');
    Route::post('/obrolan', [ChatController::class, 'sendMessage'])->name('obrolan.send');

    // Profile
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

    // Activity Log
    Route::get('/catatan-aktivitas', [ActivityController::class, 'index'])->name('catatan-aktivitas');
});

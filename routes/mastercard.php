<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mastercard\MastercardController;
use App\Http\Controllers\User\ProfileController;

Route::middleware(['auth', 'role:mastercard'])->prefix('mastercard')->name('mastercard.')->group(function () {
    // Dashboard
    Route::get('/beranda', [MastercardController::class, 'beranda'])->name('beranda');

    // User Management
    Route::get('/manajemen/pengguna', [MastercardController::class, 'manajemenPengguna'])->name('manajemen.pengguna');
    Route::get('/manajemen/akun', [MastercardController::class, 'manajemenAkun'])->name('manajemen.akun');

    // Activity Log
    Route::get('/catatan-aktivitas', [MastercardController::class, 'catatanAktivitas'])->name('catatan-aktivitas');

    // Notes
    Route::get('/catatan', [MastercardController::class, 'catatan'])->name('catatan');

    // Chat
    Route::get('/obrolan', [MastercardController::class, 'obrolan'])->name('obrolan');

    // Tools
    Route::get('/alat', [MastercardController::class, 'alat'])->name('alat');

    // Profile
    Route::get('/profil', [MastercardController::class, 'profil'])->name('profil');

    // Profile Upload Avatar
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
    });

    // Help
    Route::get('/bantuan', [MastercardController::class, 'bantuan'])->name('bantuan');
});

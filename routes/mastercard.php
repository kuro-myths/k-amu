<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mastercard\MastercardController;

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

    // Help
    Route::get('/bantuan', [MastercardController::class, 'bantuan'])->name('bantuan');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\User\ProfileController;

// Semua route untuk role USER
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/beranda', [UserController::class, 'beranda'])->name('beranda');

    // Catatan (Notes)
    Route::get('/catatan', [UserController::class, 'catatan'])->name('catatan');

    // Chat
    Route::get('/obrolan', [UserController::class, 'obrolan'])->name('obrolan');

    // Proyek
    Route::get('/proyek', [UserController::class, 'proyek'])->name('proyek');

    // Analisis / Progress
    Route::get('/analisis', [UserController::class, 'analisis'])->name('analisis');

    // Profil
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');

    // Profile - Upload Avatar, Update Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
    });

    // Bantuan
    Route::get('/bantuan', [UserController::class, 'bantuan'])->name('bantuan');
});

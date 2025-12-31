<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Leader\LeaderController;
use App\Http\Controllers\Leader\DashboardController;
use App\Http\Controllers\Leader\ProjectController;
use App\Http\Controllers\Leader\NoteController;

Route::middleware(['auth', 'role:leader'])->prefix('leader')->name('leader.')->group(function () {
    // Dashboard
    Route::get('/beranda', [LeaderController::class, 'beranda'])->name('beranda');

    // Projects
    Route::get('/proyek', [LeaderController::class, 'proyek'])->name('proyek');
    Route::get('/proyek/create', [LeaderController::class, 'proyekCreate'])->name('proyek.create');
    Route::get('/proyek/{id}', [LeaderController::class, 'proyekDetail'])->name('proyek.detail');

    // Guidance
    Route::get('/bimbingan', [LeaderController::class, 'bimbingan'])->name('bimbingan');
    Route::get('/bimbingan/create', [LeaderController::class, 'bimbinganCreate'])->name('bimbingan.create');
    Route::get('/bimbingan/{id}', [LeaderController::class, 'bimbinganDetail'])->name('bimbingan.detail');

    // Analysis
    Route::get('/analisis', [LeaderController::class, 'analisis'])->name('analisis');

    // Notes
    Route::get('/catatan', [LeaderController::class, 'catatan'])->name('catatan');

    // Chat
    Route::get('/obrolan', [LeaderController::class, 'obrolan'])->name('obrolan');

    // Profile
    Route::get('/profil', [LeaderController::class, 'profil'])->name('profil');

    // Help
    Route::get('/bantuan', [LeaderController::class, 'bantuan'])->name('bantuan');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tester\TesterController;
use App\Http\Controllers\Tester\BugController;
use App\Http\Controllers\Tester\TestingController;

Route::middleware(['auth', 'role:tester'])->prefix('tester')->name('tester.')->group(function () {
    // Dashboard
    Route::get('/beranda', [TesterController::class, 'beranda'])->name('beranda');

    // Bug Reports / Laporan
    Route::get('/laporan', [TesterController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/create', [TesterController::class, 'toolsCreate'])->name('laporan.create');

    // Test Results / Tools
    Route::get('/tools', [TesterController::class, 'tools'])->name('tools');

    // Analysis
    Route::get('/analisis', [TesterController::class, 'analisis'])->name('analisis');

    // Catatan (Notes)
    Route::get('/catatan', [TesterController::class, 'catatan'])->name('catatan');

    // Chat
    Route::get('/obrolan', [TesterController::class, 'obrolan'])->name('obrolan');

    // Profile
    Route::get('/profil', [TesterController::class, 'profil'])->name('profil');

    // Help
    Route::get('/bantuan', [TesterController::class, 'bantuan'])->name('bantuan');
});

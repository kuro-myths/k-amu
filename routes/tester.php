<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tester\DashboardController;
use App\Http\Controllers\Tester\BugController;
use App\Http\Controllers\Tester\TestingController;

Route::middleware(['auth', 'role:tester'])->prefix('tester')->name('tester.')->group(function () {
    // Dashboard
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');

    // Tools & Bug Reports
    Route::get('/tools', [BugController::class, 'index'])->name('tools');
    Route::get('/tools/create', [BugController::class, 'create'])->name('tools.create');
    Route::post('/tools', [BugController::class, 'store'])->name('tools.store');
    Route::get('/tools/{bug}', [BugController::class, 'show'])->name('tools.show');
    Route::get('/tools/{bug}/edit', [BugController::class, 'edit'])->name('tools.edit');
    Route::put('/tools/{bug}', [BugController::class, 'update'])->name('tools.update');

    // Test Results
    Route::get('/laporan', [TestingController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/create', [TestingController::class, 'createResult'])->name('laporan.create');
    Route::post('/laporan', [TestingController::class, 'storeResult'])->name('laporan.store');

    // Monitoring
    Route::get('/monitoring', [TestingController::class, 'monitoring'])->name('monitoring');

    // Statistics
    Route::get('/statistik', [TestingController::class, 'statistik'])->name('statistik');

    // Catatan (Notes)
    Route::get('/catatan', [DashboardController::class, 'catatan'])->name('catatan');

    // Chat
    Route::get('/obrolan', [DashboardController::class, 'obrolan'])->name('obrolan');

    // Profile
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');

    // Sandbox & Documentation
    Route::get('/sandbox', [DashboardController::class, 'sandbox'])->name('sandbox');
    Route::get('/dokumentasi', [DashboardController::class, 'dokumentasi'])->name('dokumentasi');
    Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
});

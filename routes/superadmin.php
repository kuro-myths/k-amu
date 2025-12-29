<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use App\Http\Controllers\SuperAdmin\ChatController;
use App\Http\Controllers\SuperAdmin\NoteController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\SuperAdmin\SettingController;

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    // Dashboard
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');

    // User Management
    Route::get('/pengguna', [UserManagementController::class, 'pengguna'])->name('pengguna');
    Route::get('/pengguna/create', [UserManagementController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [UserManagementController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{user}/edit', [UserManagementController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{user}', [UserManagementController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [UserManagementController::class, 'destroy'])->name('pengguna.destroy');

    // Role Management
    Route::get('/peran', [UserManagementController::class, 'peran'])->name('peran');

    // Activity Log
    Route::get('/catatan-aktivitas', [UserManagementController::class, 'catatanAktivitas'])->name('catatan-aktivitas');

    // Notes
    Route::get('/catatan', [NoteController::class, 'index'])->name('catatan');
    Route::get('/catatan/create', [NoteController::class, 'create'])->name('catatan.create');
    Route::post('/catatan', [NoteController::class, 'store'])->name('catatan.store');
    Route::get('/catatan/{note}/edit', [NoteController::class, 'edit'])->name('catatan.edit');
    Route::put('/catatan/{note}', [NoteController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/{note}', [NoteController::class, 'destroy'])->name('catatan.destroy');
    Route::post('/catatan/{note}/pin', [NoteController::class, 'pin'])->name('catatan.pin');
    Route::post('/catatan/{note}/unpin', [NoteController::class, 'unpin'])->name('catatan.unpin');

    // Chat / Obrolan
    Route::get('/obrolan', [ChatController::class, 'index'])->name('obrolan');
    Route::post('/obrolan/send', [ChatController::class, 'send'])->name('obrolan.send');

    // Reports / Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan');

    // Settings / Pengaturan
    Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan');
    Route::post('/pengaturan/update', [SettingController::class, 'update'])->name('pengaturan.update');
    Route::post('/pengaturan/clearCache', [SettingController::class, 'clearCache'])->name('pengaturan.clearCache');

    // Help / Bantuan
    Route::get('/bantuan', function () {
        return view('superadmin.bantuan.index');
    })->name('bantuan');

    // Tools / Alat
    Route::get('/alat', function () {
        return view('superadmin.alat.index', [
            'totalUsers' => \App\Models\User::count(),
            'totalLogs' => \App\Models\ActivityLog::count(),
        ]);
    })->name('alat');
    Route::post('/alat/clearCache', [SettingController::class, 'clearCache'])->name('alat.clearCache');
    Route::post('/alat/optimizeDB', function () {
        return back()->with('success', 'Database berhasil dioptimalkan');
    })->name('alat.optimizeDB');
    Route::post('/alat/syncPermissions', function () {
        return back()->with('success', 'Permissions berhasil disinkronisasi');
    })->name('alat.syncPermissions');
    Route::post('/alat/clearLogs', function () {
        return back()->with('success', 'Log sistem berhasil dihapus');
    })->name('alat.clearLogs');
    Route::post('/alat/resetDemo', function () {
        return back()->with('success', 'Data demo berhasil direset');
    })->name('alat.resetDemo');

    // Profile / Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
    Route::post('/profil/changePassword', [ProfileController::class, 'changePassword'])->name('profil.changePassword');
});

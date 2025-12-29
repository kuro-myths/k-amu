<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\NoteController;

// Semua route untuk role USER
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');

    // Notes
    Route::get('/catatan', [NoteController::class, 'index'])->name('catatan');
    Route::get('/catatan/create', [NoteController::class, 'create'])->name('catatan.create');
    Route::post('/catatan', [NoteController::class, 'store'])->name('catatan.store');
    Route::get('/catatan/{note}/edit', [NoteController::class, 'edit'])->name('catatan.edit');
    Route::put('/catatan/{note}', [NoteController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/{note}', [NoteController::class, 'destroy'])->name('catatan.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Leader\DashboardController;
use App\Http\Controllers\Leader\ProjectController;
use App\Http\Controllers\Leader\NoteController;

Route::middleware(['auth', 'role:leader'])->prefix('leader')->name('leader.')->group(function () {
    // Dashboard
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');

    // Projects
    Route::get('/proyek', [ProjectController::class, 'index'])->name('proyek');
    Route::get('/proyek/create', [ProjectController::class, 'create'])->name('proyek.create');
    Route::post('/proyek', [ProjectController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/{project}/edit', [ProjectController::class, 'edit'])->name('proyek.edit');
    Route::put('/proyek/{project}', [ProjectController::class, 'update'])->name('proyek.update');
    Route::delete('/proyek/{project}', [ProjectController::class, 'destroy'])->name('proyek.destroy');

    // Notes
    Route::get('/catatan', [NoteController::class, 'index'])->name('catatan');
    Route::get('/catatan/create', [NoteController::class, 'create'])->name('catatan.create');
    Route::post('/catatan', [NoteController::class, 'store'])->name('catatan.store');
    Route::get('/catatan/{note}/edit', [NoteController::class, 'edit'])->name('catatan.edit');
    Route::put('/catatan/{note}', [NoteController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/{note}', [NoteController::class, 'destroy'])->name('catatan.destroy');
});

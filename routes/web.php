<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');

// register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.process');

// dashboard (protected)
Route::get('/dashboard', function () {
    return 'Login berhasil 🎉';
})->middleware('auth');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

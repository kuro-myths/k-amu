<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard umum (protected)
Route::middleware('auth')->get('/dashboard', function () {
    return 'Login berhasil 🎉';
});

// Include route per role
include 'user.php';
include 'leader.php';
include 'mastercard.php';
include 'superadmin.php';
include 'tester.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Mascot & Pet Routes - Require Auth
Route::middleware('auth')->group(function () {
    Route::get('/mascot', [PetController::class, 'show'])->name('mascot');
    Route::post('/pet/interact', [PetController::class, 'interact']);
    Route::post('/pet/rest', [PetController::class, 'rest']);
    Route::post('/pet/chat', [PetController::class, 'chat']);
    Route::post('/pet/motivation', [PetController::class, 'getMotivation']);
    Route::post('/pet/learning-tip', [PetController::class, 'getLearningTip']);

    // Theme Routes
    Route::get('/api/theme', [\App\Http\Controllers\ThemeController::class, 'show'])->name('theme.show');
    Route::post('/api/theme', [\App\Http\Controllers\ThemeController::class, 'update'])->name('theme.update');
    Route::post('/api/theme/reset', [\App\Http\Controllers\ThemeController::class, 'reset'])->name('theme.reset');
    Route::get('/api/theme/presets', [\App\Http\Controllers\ThemeController::class, 'presets'])->name('theme.presets');
    Route::get('/theme-settings', function () {
        return view('theme-settings');
    })->name('theme-settings');

    // Search Routes
    Route::post('/api/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search.search');
    Route::get('/api/search/history', [\App\Http\Controllers\SearchController::class, 'history'])->name('search.history');
    Route::get('/api/search/bookmarks', [\App\Http\Controllers\SearchController::class, 'bookmarks'])->name('search.bookmarks');
    Route::get('/api/search/tag/{tag}', [\App\Http\Controllers\SearchController::class, 'searchByTag'])->name('search.byTag');
    Route::post('/api/search/{searchHistory}/tag', [\App\Http\Controllers\SearchController::class, 'addTag'])->name('search.addTag');
    Route::delete('/api/search/{searchHistory}/tag', [\App\Http\Controllers\SearchController::class, 'removeTag'])->name('search.removeTag');
    Route::post('/api/search/{searchHistory}/bookmark', [\App\Http\Controllers\SearchController::class, 'toggleBookmark'])->name('search.toggleBookmark');
    Route::delete('/api/search/history', [\App\Http\Controllers\SearchController::class, 'clearHistory'])->name('search.clearHistory');
    Route::get('/search', function () {
        return view('search');
    })->name('search');
});
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

<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute login dan logout
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Arahkan root ke halaman login atau dashboard
Route::get('/', function () {
    // Menggunakan middleware auth agar memeriksa apakah pengguna sudah login
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Arahkan ke dashboard jika sudah login
    }
    return redirect()->route('login'); // Jika belum login, arahkan ke login
});

// Rute yang memerlukan autentikasi
Route::middleware(IsLogin::class)->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute buku
    Route::prefix('/bukus')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('bukus.index');
        Route::get('/create', [BukuController::class, 'create'])->name('bukus.create');
        Route::get('/edit/{id}', [BukuController::class, 'edit'])->name('bukus.edit');
        Route::post('/store', [BukuController::class, 'store'])->name('bukus.store');
        Route::put('/{id}', [BukuController::class, 'update'])->name('bukus.update');
        Route::delete('/{id}', [BukuController::class, 'delete'])->name('bukus.delete');
    });

    // Rute kategori
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    });
});

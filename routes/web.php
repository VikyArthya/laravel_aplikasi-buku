<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(IsLogin::class)->group(function(){

    Route::get('/', [DashboardController::class, 'index']);


    Route::get('/bukus', [BukuController::class, 'index']);
    Route::get('/bukus/create', [BukuController::class, 'create']);
    Route::get('/bukus/edit/{id}', [BukuController::class, 'edit']);
    Route::post('/bukus/store', [BukuController::class, 'store']);
    Route::put('/bukus/{id}', [BukuController::class, 'update']);
    Route::delete('/bukus/{id}', [BukuController::class, 'delete']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

});
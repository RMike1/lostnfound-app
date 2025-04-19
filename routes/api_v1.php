<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Home\ItemController;
use Illuminate\Support\Facades\Route;

// ============================Auth Routes========================================

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/forgot-password', 'forgotPassword')->name('password.email');
    Route::post('/reset-password', 'resetPassword')->name('password.reset');
    Route::post('/logout', 'logout')->middleware('auth:sanctum')->name('logout');
});

// ========================================Items Routes========================================

// Route::prefix('items')->middleware(['auth:sanctum'])->controller(ItemController::class)->group(function () {
Route::prefix('items')->controller(ItemController::class)->group(function () {
    Route::get('/', 'index')->name('items.index');
    Route::post('/store', 'store')->name('items.store');
});

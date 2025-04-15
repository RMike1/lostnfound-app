<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Home\ItemController;
use App\Http\Controllers\Api\V1\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
use App\Http\Controllers\Api\V1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\V1\Auth\EmailVerificationNotificationController;

//============================Auth Routes========================================

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.reset');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(middleware: ['auth:sanctum', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum')->name('logout');

//========================================Items Routes========================================

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// Route::post('/items/store', [ItemController::class, 'store'])->middleware('auth:sanctum')->name('items.store');
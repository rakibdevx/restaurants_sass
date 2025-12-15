<?php

use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('owner')->name('owner.')->group(function () {

    // Guest routes (login, register, forgot password)
    Route::middleware('guest:owner','web')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login']);

        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [AuthController::class, 'register']);

        Route::get('forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

        Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    });

    // Authenticated routes (dashboard, logout, profile etc.)
    Route::middleware(['auth:owner','web'])->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('purchase/{id}', [DashboardController::class, 'purchase'])->name('purchase');

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/', [ProfileController::class, 'update']);

            Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');

            Route::get('information', [ProfileController::class, 'information'])->name('information');
            Route::post('information', [ProfileController::class, 'information_update']);

            Route::get('business', [ProfileController::class, 'business'])->name('business');
            Route::post('business', [ProfileController::class, 'business_update']);
        });
    });

});

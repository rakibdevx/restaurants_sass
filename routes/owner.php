<?php

use App\Http\Controllers\Owner\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('owner')->name('owner.')->group(function () {

    // Guest routes (login, register, forgot password)
    Route::middleware('guest:owner')->group(function () {
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
    Route::middleware(['auth:owner', 'owner.status.active'])->group(function () {
        Route::get('dashboard', function () {
            return view('owner.dashboard');
        })->name('dashboard');

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // Optional: profile routes
        Route::get('profile', function () {
            return view('owner.profile');
        })->name('profile');

        Route::post('profile', function (Request $request) {
            // profile update logic
        })->name('profile.update');

        // Optional: 2FA verification
        Route::get('2fa/verify', function () {
            return view('owner.2fa.verify');
        })->name('2fa.verify');

        Route::post('2fa/verify', function (Request $request) {
            // 2FA verification logic
        })->name('2fa.verify.post');
    });

});

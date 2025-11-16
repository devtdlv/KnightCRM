<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Authentication Routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    // Password Reset
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Email Verification
Route::middleware('auth')->group(function () {
    Route::get('/verify-email', [VerifyEmailController::class, 'notice'])->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');
});

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('/export', [LeadController::class, 'export'])->name('export');
    });

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/{id}/notes', [ClientController::class, 'notes'])->name('notes');
        Route::get('/export', [ClientController::class, 'export'])->name('export');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
    });

    Route::prefix('reminders')->name('reminders.')->group(function () {
        Route::get('/', [ReminderController::class, 'index'])->name('index');
    });
});

// Public homepage (redirects to dashboard if already authenticated)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');


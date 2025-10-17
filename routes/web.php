<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\CapitalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BusinessInfoController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-new');
});

// Custom Auth Routes
Route::get('/register-custom', function () {
    return view('auth.register-custom');
})->name('register.custom');

Route::get('/login-custom', function () {
    return view('auth.login-custom');
})->name('login.custom');

// Custom Password Reset Routes
Route::get('/forgot-password-custom', [PasswordResetController::class, 'showForgotPassword'])->name('password.forgot');
Route::post('/forgot-password-custom', [PasswordResetController::class, 'sendResetEmail'])->name('password.send-reset');
Route::get('/verify-email-custom', [PasswordResetController::class, 'showVerification'])->name('password.verify');
Route::post('/verify-email-custom', [PasswordResetController::class, 'verifyCode'])->name('password.verify-code');
Route::post('/resend-code-custom', [PasswordResetController::class, 'resendCode'])->name('password.resend');
Route::get('/reset-password-custom/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password-custom', [PasswordResetController::class, 'resetPassword'])->name('password.reset-submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Transactions
    Route::resource('transactions', TransactionController::class);
    Route::post('transactions/{transaction}/upload-proof', [TransactionController::class, 'uploadProof'])->name('transactions.upload-proof');
    
    // Taxes - Specific routes first (before resource routes)
    Route::get('taxes/dashboard', [TaxController::class, 'dashboard'])->name('taxes.dashboard');
    Route::post('taxes/calculate', [TaxController::class, 'calculate'])->name('taxes.calculate');
    Route::post('taxes/store', [TaxController::class, 'store'])->name('taxes.store');
    Route::get('taxes/export-pdf', [TaxController::class, 'exportPdf'])->name('taxes.export-pdf');
    Route::get('taxes/reminders', [TaxController::class, 'generateReminders'])->name('taxes.reminders');
    Route::post('taxes/auto-calculate', [TaxController::class, 'autoCalculateMonthly'])->name('taxes.auto-calculate');
    
    // Annual Tax Report
    Route::get('taxes/annual-report', [TaxController::class, 'annualReport'])->name('taxes.annual-report');
    Route::post('taxes/auto-calculate-yearly', [TaxController::class, 'autoCalculateYearly'])->name('taxes.auto-calculate-yearly');
    Route::get('taxes/export-annual-pdf', [TaxController::class, 'exportAnnualPdf'])->name('taxes.export-annual-pdf');
    
    // Monthly Tax History
    Route::get('taxes/monthly-history', [TaxController::class, 'monthlyHistory'])->name('taxes.monthly-history');
    Route::post('taxes/auto-save-all', [TaxController::class, 'autoSaveAllTaxes'])->name('taxes.auto-save-all');
    
    
    // Taxes Resource Routes (must be last)
    Route::resource('taxes', TaxController::class);
    
    // Capitals
    Route::resource('capitals', CapitalController::class);
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
    Route::get('/reports/data', [ReportController::class, 'getData'])->name('reports.data');
    
    // Additional Report Routes
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/yearly', [ReportController::class, 'yearly'])->name('reports.yearly');

        // Business Info
        Route::get('/business-info', [BusinessInfoController::class, 'index'])->name('business-info.index');
        Route::get('/business-info/edit', [BusinessInfoController::class, 'edit'])->name('business-info.edit');
        Route::put('/business-info', [BusinessInfoController::class, 'update'])->name('business-info.update');
        Route::get('/business-info/statistics', [BusinessInfoController::class, 'statistics'])->name('business-info.statistics');

        // Theme & Appearance
        Route::get('/theme', [ThemeController::class, 'index'])->name('theme.index');
        Route::put('/theme', [ThemeController::class, 'update'])->name('theme.update');
        Route::post('/theme/reset', [ThemeController::class, 'reset'])->name('theme.reset');
        Route::post('/theme/preview', [ThemeController::class, 'preview'])->name('theme.preview');
        Route::get('/theme/preferences', [ThemeController::class, 'getPreferences'])->name('theme.preferences');
});
require __DIR__.'/auth.php';


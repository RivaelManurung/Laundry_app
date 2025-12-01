<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-attempt', [AuthController::class, 'loginAttempt'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kasir & Transaksi
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('/transactions/processing', [TransactionController::class, 'processing'])->name('transactions.processing');
    Route::get('/transactions/ready', [TransactionController::class, 'ready'])->name('transactions.ready');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');

    // Master Data
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    // Keuangan & Laporan
    Route::get('/finance/cash-flow', [FinanceController::class, 'cashFlow'])->name('finance.cash-flow');
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/profit-loss', [ReportController::class, 'profitAndLoss'])->name('reports.profit-loss');
    Route::get('/reports/employee-performance', [ReportController::class, 'employeePerformance'])->name('reports.employee-performance');

    // Sistem
    Route::get('/settings/shop-profile', [SettingController::class, 'shopProfile'])->name('settings.shop-profile');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

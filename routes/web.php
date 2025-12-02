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
use App\Http\Controllers\PaymentController;

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
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/processing', [TransactionController::class, 'processing'])->name('transactions.processing');
    Route::get('/transactions/ready', [TransactionController::class, 'ready'])->name('transactions.ready');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.update-status');

    // Pembayaran Midtrans
    Route::get('/transactions/{transaction}/pay', [PaymentController::class, 'pay'])->name('transactions.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

    // Master Data
    Route::resource('customers', CustomerController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('inventory', InventoryController::class);

    // Keuangan & Laporan
    Route::get('/finance/cash-flow', [FinanceController::class, 'cashFlow'])->name('finance.cash-flow');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports/profit-loss', [ReportController::class, 'profitAndLoss'])->name('reports.profit-loss');
    Route::get('/reports/employee-performance', [ReportController::class, 'employeePerformance'])->name('reports.employee-performance');

    // Sistem
    Route::get('/settings/shop-profile', [SettingController::class, 'shopProfile'])->name('settings.shop-profile');
    Route::put('/settings/shop-profile', [SettingController::class, 'updateShopProfile'])->name('settings.update-shop-profile');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

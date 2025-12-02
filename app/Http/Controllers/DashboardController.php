<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA KARTU STATISTIK
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Pendapatan Hari Ini
        $incomeToday = Transaction::whereDate('created_at', $today)->sum('total_amount');
        $incomeYesterday = Transaction::whereDate('created_at', $yesterday)->sum('total_amount');
        
        // Hitung persentase kenaikan/penurunan
        $percentageChange = 0;
        if ($incomeYesterday > 0) {
            $percentageChange = (($incomeToday - $incomeYesterday) / $incomeYesterday) * 100;
        } elseif ($incomeToday > 0) {
            $percentageChange = 100; // Jika kemarin 0 dan hari ini ada, naik 100%
        }

        // Counter Status
        $processingCount = Transaction::where('status', 'processing')->count();
        $readyCount = Transaction::where('status', 'ready')->count();
        
        // Pelanggan
        $customerCount = Customer::count();
        $newCustomersToday = Customer::whereDate('created_at', $today)->count();

        // 2. DATA TABEL TRANSAKSI TERBARU (Ambil 5 saja)
        $recentTransactions = Transaction::with('customer')
                                ->latest()
                                ->take(5)
                                ->get();

        // 3. DATA STOK MENIPIS (Ambil 5 barang yang stok <= minimum)
        // Asumsi di Model Inventory ada kolom 'minimum_stock'
        $lowStockItems = Inventory::whereColumn('stock', '<=', 'minimum_stock')
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'incomeToday', 
            'percentageChange',
            'processingCount',
            'readyCount',
            'customerCount',
            'newCustomersToday',
            'recentTransactions',
            'lowStockItems'
        ));
    }
}
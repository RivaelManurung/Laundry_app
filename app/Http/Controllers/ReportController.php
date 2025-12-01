<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function daily()
    {
        $today = Carbon::today();
        $transactions = Transaction::whereDate('created_at', $today)->get();
        $totalIncome = $transactions->sum('total_amount');
        return view('reports.daily', compact('transactions', 'totalIncome'));
    }

    public function profitAndLoss()
    {
        return view('reports.profit-loss');
    }

    public function employeePerformance()
    {
        return view('reports.employee-performance');
    }
}

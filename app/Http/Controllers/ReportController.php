<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return redirect()->route('reports.daily');
    }

    public function daily(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());
        
        $query = Transaction::with('customer')->whereDate('created_at', $date);
        
        $totalIncome = $query->sum('total_amount');
        $totalTransactions = $query->count();
        
        $transactions = $query->latest()->paginate(10)->withQueryString();
        
        return view('reports.daily', compact('transactions', 'totalIncome', 'totalTransactions', 'date'));
    }

    public function weekly(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

        $query = Transaction::with('customer')->whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(), 
            Carbon::parse($endDate)->endOfDay()
        ]);

        $totalIncome = $query->sum('total_amount');
        $totalTransactions = $query->count();

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('reports.weekly', compact('transactions', 'totalIncome', 'totalTransactions', 'startDate', 'endDate'));
    }

    public function monthly(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $query = Transaction::with('customer')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        $totalIncome = $query->sum('total_amount');
        $totalTransactions = $query->count();

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('reports.monthly', compact('transactions', 'totalIncome', 'totalTransactions', 'month', 'year'));
    }

    public function export(Request $request)
    {
        $type = $request->input('type', 'daily');
        $format = $request->input('format', 'pdf');
        
        $query = Transaction::with('customer');
        $title = 'Laporan';
        $period = '';

        if ($type == 'daily') {
            $date = $request->input('date', Carbon::today()->toDateString());
            $query->whereDate('created_at', $date);
            $title = 'Laporan Harian';
            $period = Carbon::parse($date)->format('d M Y');
        } elseif ($type == 'weekly') {
            $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
            $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(), 
                Carbon::parse($endDate)->endOfDay()
            ]);
            $title = 'Laporan Mingguan';
            $period = Carbon::parse($startDate)->format('d M Y') . ' - ' . Carbon::parse($endDate)->format('d M Y');
        } elseif ($type == 'monthly') {
            $month = $request->input('month', Carbon::now()->month);
            $year = $request->input('year', Carbon::now()->year);
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
            $title = 'Laporan Bulanan';
            $period = Carbon::create()->month($month)->year($year)->format('F Y');
        }

        $transactions = $query->latest()->get();
        $totalIncome = $transactions->sum('total_amount');

        if ($format == 'pdf') {
            $pdf = Pdf::loadView('reports.pdf', compact('transactions', 'totalIncome', 'title', 'period'));
            return $pdf->download('laporan_' . $type . '_' . time() . '.pdf');
        } elseif ($format == 'excel') {
            return Excel::download(new ReportExport($transactions, $title, $period), 'laporan_' . $type . '_' . time() . '.xlsx');
        }
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

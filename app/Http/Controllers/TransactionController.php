<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Package;

class TransactionController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $packages = Package::all();
        return view('transactions.create', compact('customers', 'packages'));
    }

    public function processing()
    {
        $transactions = Transaction::where('status', 'processing')->with('customer')->get();
        return view('transactions.processing', compact('transactions'));
    }

    public function ready()
    {
        $transactions = Transaction::where('status', 'ready')->with('customer')->get();
        return view('transactions.ready', compact('transactions'));
    }

    public function history()
    {
        $transactions = Transaction::with('customer')->latest()->get();
        return view('transactions.history', compact('transactions'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'package_id' => 'required|exists:packages,id',
            'quantity' => 'required|numeric|min:0.1',
            'deadline' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $package = Package::find($request->package_id);
        $total_price = $package->price * $request->quantity;

        $transaction = Transaction::create([
            'customer_id' => $request->customer_id,
            'user_id' => Auth::id() ?? 1,
            'invoice_code' => 'TRX-' . time(),
            'total_amount' => $total_price,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'deadline' => $request->deadline,
            'notes' => $request->notes,
        ]);

        $transaction->details()->create([
            'package_id' => $request->package_id,
            'quantity' => $request->quantity,
            'price' => $package->price,
            'subtotal' => $total_price,
        ]);

        return redirect()->route('transactions.processing')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $request->status]);
        
        if ($request->status == 'ready') {
             return redirect()->route('transactions.ready')->with('success', 'Status transaksi diperbarui menjadi Siap Ambil.');
        } elseif ($request->status == 'done') {
             return redirect()->route('transactions.history')->with('success', 'Transaksi selesai.');
        }

        return back()->with('success', 'Status transaksi diperbarui.');
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

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

    public function processing(Request $request)
    {
        // 1. Mulai Query
        $query = Transaction::query();

        // 2. Filter Status (Hanya ambil yang pending & processing)
        $query->whereIn('status', ['pending', 'processing']);

        // 3. Eager Load Relasi Customer (Biar ringan)
        $query->with('customer');

        // 4. Logika Search
        if ($request->filled('search')) {
            $search = $request->input('search');

            // Gunakan where(function(...)) agar logika OR tidak merusak filter status
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 5. Urutkan dari yang terbaru
        $query->orderBy('created_at', 'desc');

        // 6. Eksekusi Pagination (Jangan pakai get() lagi setelah ini)
        $transactions = $query->paginate(10)->withQueryString();

        return view('transactions.processing', compact('transactions'));
    }

    public function ready(Request $request)
    {
        $query = Transaction::query();
        $query->where('status', 'ready');
        $query->with('customer');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $query->orderBy('updated_at', 'desc');
        $transactions = $query->paginate(10)->withQueryString();

        return view('transactions.ready', compact('transactions'));
    }

    public function history(Request $request)
    {
        $query = Transaction::query();
        $query->with('customer');

        // History biasanya menampilkan yang sudah selesai atau dibatalkan
        // Tapi jika user ingin "Semua Riwayat" termasuk yang pending, kita bisa sesuaikan.
        // Default history biasanya 'done' atau 'cancelled'. 
        // Namun kode sebelumnya `Transaction::with('customer')->latest()->get()` mengambil SEMUA status.
        // Jadi saya akan tetap mengambil semua status untuk history, atau mungkin filter status 'done'/'cancelled' jika itu maksudnya.
        // Mengikuti kode lama: ambil semua.
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $query->orderBy('created_at', 'desc');
        $transactions = $query->paginate(10)->withQueryString();

        return view('transactions.history', compact('transactions'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan dengan fitur Search, Filter, dan Pagination.
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi Query Builder
        $query = Customer::query();

        // 2. Logika Pencarian (Search)
        // Mengecek apakah ada input 'search' dari form
        if ($request->filled('search')) {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%") // Asumsi ada kolom email
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // 3. Logika Filtering / Sorting
        // Mengecek apakah ada input 'sort' dari dropdown
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'newest':
                default:
                    $query->latest(); // Default: Terbaru (created_at desc)
                    break;
            }
        } else {
            // Default jika tidak ada filter: Tampilkan yang terbaru
            $query->latest();
        }

        // 4. Pagination
        // Menampilkan 10 data per halaman
        // withQueryString() penting agar saat klik halaman 2, pencarian tidak hilang
        $customers = $query->paginate(10)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255', // Saya tambahkan validasi email jika ada
            'address' => 'nullable|string',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
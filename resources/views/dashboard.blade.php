@extends('layouts.admin')

@section('title', 'Dashboard - Laundry Admin')
@section('header-title', 'Overview Bisnis')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-2 bg-emerald-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h3>
                    
                    <p class="text-xs mt-1 flex items-center font-medium {{ $percentageChange >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                        @if($percentageChange >= 0)
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +{{ number_format($percentageChange, 1) }}%
                        @else
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                            {{ number_format($percentageChange, 1) }}%
                        @endif
                        <span class="text-gray-400 ml-1">dari kemarin</span>
                    </p>
                </div>
                <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <a href="{{ route('transactions.processing') }}" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all cursor-pointer">
            <div class="absolute right-0 top-0 h-full w-2 bg-blue-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $processingCount }} <span class="text-sm font-normal text-gray-400">Pesanan</span></h3>
                    <p class="text-xs text-gray-500 mt-1">Perlu dicuci/setrika</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
        </a>

        <a href="{{ route('transactions.ready') }}" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all cursor-pointer">
            <div class="absolute right-0 top-0 h-full w-2 bg-amber-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Siap Diambil</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $readyCount }} <span class="text-sm font-normal text-gray-400">Pesanan</span></h3>
                    <p class="text-xs text-amber-600 mt-1 font-medium">Menunggu pelanggan</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-lg text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-2 bg-indigo-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $customerCount }}</h3>
                    <p class="text-xs text-indigo-600 mt-1 flex items-center font-medium">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        {{ $newCustomersToday }} Baru hari ini
                    </p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Transaksi Terbaru</h3>
                    <a href="{{ route('transactions.history') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua &rarr;</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                            <tr>
                                <th class="px-6 py-4">Invoice</th>
                                <th class="px-6 py-4">Pelanggan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentTransactions as $trx)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-xs font-medium text-gray-500">
                                        {{ $trx->invoice_code }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="flex items-center gap-2">
                                            <div class="h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                                {{ substr($trx->customer->name, 0, 1) }}
                                            </div>
                                            {{ $trx->customer->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($trx->status == 'pending')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                Pending
                                            </span>
                                        @elseif($trx->status == 'processing')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                Proses
                                            </span>
                                        @elseif($trx->status == 'ready')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                                Siap Ambil
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-700 text-right">
                                        Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">
                                        Belum ada transaksi hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('transactions.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-primary-50 text-primary-700 hover:bg-primary-100 transition border border-primary-100 group">
                        <svg class="w-8 h-8 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span class="text-sm font-medium">Transaksi</span>
                    </a>
                    <a href="{{ route('customers.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition border border-indigo-100 group">
                        <svg class="w-8 h-8 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        <span class="text-sm font-medium">Pelanggan</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-3 border-b border-gray-100 flex justify-between items-center bg-red-50/30">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Stok Menipis
                    </h3>
                    <a href="{{ route('inventory.index') }}" class="text-xs text-gray-500 hover:text-gray-700">Lihat Semua</a>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($lowStockItems as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full {{ $item->stock == 0 ? 'bg-red-600' : 'bg-amber-500' }}"></div>
                                <span class="text-sm text-gray-600">{{ $item->name }}</span>
                            </div>
                            <span class="text-sm font-bold {{ $item->stock == 0 ? 'text-red-600' : 'text-amber-600' }}">
                                Sisa {{ $item->stock }} {{ $item->unit }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-sm text-gray-500 flex flex-col items-center">
                            <svg class="w-8 h-8 text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Stok aman terkendali.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection
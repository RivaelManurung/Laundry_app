@extends('layouts.admin')

@section('title', 'Transaksi Baru')
@section('header-title', 'Transaksi Baru')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Selection -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Pelanggan</label>
                    <select id="customer_id" name="customer_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Pilih Pelanggan</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-500"><a href="{{ route('customers.create') }}" class="text-indigo-600 hover:text-indigo-500">Tambah Pelanggan Baru</a></p>
                </div>

                <!-- Deadline -->
                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Target Selesai</label>
                    <input type="datetime-local" name="deadline" id="deadline" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Pesanan</h3>
                <div class="mt-2 bg-gray-50 p-4 rounded-md">
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Simple implementation for now, ideally dynamic JS rows -->
                        <div>
                            <label for="package_id" class="block text-sm font-medium text-gray-700">Pilih Paket</label>
                            <select id="package_id" name="package_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }} / {{ $package->unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah / Berat</label>
                            <input type="number" name="quantity" id="quantity" step="0.1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Contoh: 2.5">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                <textarea id="notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                    Batal
                </button>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
@endsection

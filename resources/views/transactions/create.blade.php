@extends('layouts.admin')

@section('title', 'Buat Transaksi Baru')
@section('header-title', 'Transaksi Laundry')

@section('content')
    <div x-data="transactionForm()" class="max-w-7xl mx-auto">
        
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-base font-semibold text-gray-800">Informasi Pelanggan</h3>
                            <a href="{{ route('customers.create') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Pelanggan Baru
                            </a>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1">
                                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Pelanggan</label>
                                <div class="relative">
                                    <select id="customer_id" name="customer_id" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-lg shadow-sm transition-shadow">
                                        <option value="">-- Cari Pelanggan --</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Target Selesai</label>
                                <input type="datetime-local" name="deadline" id="deadline" required
                                    class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">Estimasi waktu pengerjaan standar: 2 Hari.</p>
                            </div>

                            <div class="col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan / Request Khusus</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Contoh: Jangan disetrika terlalu panas, pisahkan pakaian putih..."
                                    class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="text-base font-semibold text-gray-800">Rincian Cucian</h3>
                        </div>
                        <div class="p-6 bg-white">
                            <div class="space-y-4">
                                <div class="flex flex-col md:flex-row gap-4 items-start md:items-end p-4 border border-gray-100 rounded-lg bg-gray-50/30">
                                    
                                    <div class="flex-1 w-full">
                                        <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Layanan / Paket</label>
                                        <select name="package_id" x-model="selectedPackageId" @change="updatePrice()" required
                                            class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                            <option value="" data-price="0">Pilih Layanan...</option>
                                            @foreach($packages as $package)
                                                <option value="{{ $package->id }}" data-price="{{ $package->price }}" data-unit="{{ $package->unit }}">
                                                    {{ $package->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-full md:w-32">
                                        <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Qty / Berat</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <input type="number" name="quantity" step="0.1" min="0.1" x-model="quantity" required
                                                class="block w-full py-2 pl-3 pr-10 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-xs" x-text="unitLabel">Kg</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-40">
                                        <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Harga Satuan</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="text" readonly x-model="formattedPrice"
                                                class="block w-full py-2 pl-9 border border-gray-200 bg-gray-100 text-gray-500 rounded-md sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 sticky top-6">
                        <div class="p-6 space-y-6">
                            <h3 class="text-lg font-bold text-gray-800">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-3 pt-4 border-t border-gray-100">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-medium" x-text="formatRupiah(total)">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Pajak (0%)</span> <span class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Diskon</span>
                                    <span class="font-medium text-green-600">- Rp 0</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                                    <span class="text-xl font-bold text-primary-600" x-text="formatRupiah(total)">Rp 0</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 text-right">*Harga belum termasuk biaya antar-jemput</p>
                            </div>

                            <div class="grid grid-cols-1 gap-3 pt-4">
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                                    Simpan Transaksi
                                </button>
                                <a href="{{ route('dashboard') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function transactionForm() {
            return {
                selectedPackageId: '',
                quantity: 1,
                pricePerUnit: 0,
                unitLabel: 'Satuan',
                
                // Getter untuk total
                get total() {
                    return this.quantity * this.pricePerUnit;
                },

                // Getter untuk format harga satuan tampilan
                get formattedPrice() {
                    return new Intl.NumberFormat('id-ID').format(this.pricePerUnit);
                },

                // Fungsi dijalankan saat dropdown paket berubah
                updatePrice() {
                    // Ambil elemen select
                    const select = document.querySelector('select[name="package_id"]');
                    const selectedOption = select.options[select.selectedIndex];
                    
                    // Ambil data-price dan data-unit dari option yang dipilih
                    this.pricePerUnit = selectedOption.getAttribute('data-price') || 0;
                    this.unitLabel = selectedOption.getAttribute('data-unit') || 'Satuan';
                },

                // Helper format rupiah
                formatRupiah(value) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                }
            }
        }
    </script>
@endsection
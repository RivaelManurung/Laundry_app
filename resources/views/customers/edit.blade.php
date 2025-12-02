@extends('layouts.admin')

@section('title', 'Edit Pelanggan')
@section('header-title', 'Edit Data Pelanggan')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden">

        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Edit Data Diri</h3>
            <p class="mt-1 text-sm text-gray-500">Perbarui informasi pelanggan di bawah ini.</p>
        </div>

        {{-- Perubahan 1: Route mengarah ke update dengan ID customer --}}
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            {{-- Perubahan 2: Method PUT wajib untuk update data --}}
            @method('PUT')

            <div class="px-8 py-8">
                <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                    <div class="sm:col-span-1">
                        <label for="name" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative mt-2">
                            {{-- Perubahan 3: Value diambil dari data customer --}}
                            <input type="text" name="name" id="name" required
                                value="{{ old('name', $customer->name) }}"
                                class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="phone" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <div class="relative mt-2">
                            <input type="text" name="phone" id="phone" required placeholder="08..."
                                value="{{ old('phone', $customer->phone) }}"
                                class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative mt-2">
                            {{-- Pastikan kolom email ada di database, jika tidak hapus input ini --}}
                            <input type="email" name="email" id="email" placeholder="contoh: 6H0lD@example.com"
                                value="{{ old('email', $customer->email ?? '') }}"
                                class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <div class=" sm:col-span-2">
                        <label for="address" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
                            Alamat Lengkap
                        </label>
                        <div class="relative mt-2">
                            {{-- Untuk Textarea, value ditaruh di antara tag pembuka dan penutup --}}
                            <textarea name="address" id="address" rows="4"
                                class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out resize-none">{{ old('address', $customer->address) }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Tuliskan nama jalan, nomor rumah, RT/RW, dan
                            kelurahan.</p>
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-end gap-x-4 px-8 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('customers.index') }}"
                    class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-white hover:text-gray-900 hover:shadow-sm ring-1 ring-inset ring-gray-300 transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
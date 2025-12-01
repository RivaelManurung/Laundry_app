@extends('layouts.admin')

@section('title', 'Profil Toko / Outlet')
@section('header-title', 'Profil Toko / Outlet')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('settings.update-shop-profile') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="shop_name" class="block text-sm font-medium text-gray-700">Nama Laundry</label>
                    <input type="text" name="shop_name" id="shop_name" value="{{ $settings['shop_name'] ?? '' }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="shop_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="shop_address" id="shop_address" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $settings['shop_address'] ?? '' }}</textarea>
                </div>

                <div>
                    <label for="shop_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="shop_phone" id="shop_phone" value="{{ $settings['shop_phone'] ?? '' }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

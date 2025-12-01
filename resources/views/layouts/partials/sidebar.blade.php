<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-20 lg:hidden" x-cloak></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-72 bg-slate-900 text-white transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col shadow-2xl">

    <div class="flex items-center justify-center h-20 border-b border-slate-800 px-6 bg-slate-950">
        <div class="flex items-center gap-3 font-bold text-xl tracking-wide">
            <div class="bg-primary-600 p-2 rounded-lg shadow-lg shadow-primary-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                    </path>
                </svg>
            </div>
            <span class="text-white">Laundry<span class="text-primary-500">Admin</span></span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            Dashboard Overview
        </a>

        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Kasir & Transaksi</p>

        <a href="{{ route('transactions.create') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.create') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.create') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                </path>
            </svg>
            Kasir / Transaksi Baru
        </a>

        <a href="{{ route('transactions.processing') }}"
            class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.processing') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.processing') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Pesanan Diproses
            </div>
            <span class="bg-primary-600 text-white text-[10px] px-2 py-0.5 rounded-full">12</span>
        </a>

        <a href="{{ route('transactions.ready') }}"
            class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.ready') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.ready') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
                Siap Diambil
            </div>
            <span class="bg-green-600 text-white text-[10px] px-2 py-0.5 rounded-full">5</span>
        </a>

        <a href="{{ route('transactions.history') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.history') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.history') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                </path>
            </svg>
            Riwayat Transaksi
        </a>

        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Master Data</p>

        <a href="{{ route('customers.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('customers.index') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customers.index') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            Data Pelanggan
        </a>

        <a href="{{ route('packages.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('packages.index') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('packages.index') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                </path>
            </svg>
            Paket & Layanan
        </a>

        <a href="{{ route('inventory.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('inventory.index') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('inventory.index') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Stok (Deterjen/Parfum)
        </a>

        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Keuangan & Laporan</p>

        <a href="{{ route('finance.cash-flow') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('finance.cash-flow') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('finance.cash-flow') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            Arus Kas (Operasional)
        </a>

        <div x-data="{ open: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex w-full items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Pusat Laporan
                </div>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="pl-12 pr-4 space-y-1 mt-1 bg-slate-950 py-2">
                <a href="{{ route('reports.daily') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('reports.daily') ? 'text-primary-400 font-medium' : 'text-slate-400 hover:text-primary-400' }}">Laporan
                    Harian</a>
                <a href="{{ route('reports.profit-loss') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('reports.profit-loss') ? 'text-primary-400 font-medium' : 'text-slate-400 hover:text-primary-400' }}">Laporan
                    Laba Rugi</a>
                <a href="{{ route('reports.employee-performance') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('reports.employee-performance') ? 'text-primary-400 font-medium' : 'text-slate-400 hover:text-primary-400' }}">Kinerja
                    Karyawan</a>
            </div>
        </div>

        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Sistem</p>

        <a href="{{ route('settings.shop-profile') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.shop-profile') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('settings.shop-profile') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
            Profil Toko / Outlet
        </a>

        <a href="{{ route('settings.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.index') ? 'bg-primary-600 text-white shadow-md shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('settings.index') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Pengaturan
        </a>

    </nav>

    <div class="border-t border-slate-800 p-4 bg-slate-950">
        <a href="#" class="flex items-center gap-3 hover:bg-slate-900 p-2 rounded-lg transition-colors">
            <div class="flex-shrink-0">
                <div
                    class="h-8 w-8 rounded bg-primary-600 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">
                    {{ Auth::user()->name ?? 'Administrator' }}
                </p>
                <p class="text-xs text-slate-500 truncate">
                    Lihat Profil
                </p>
            </div>
        </a>
    </div>
</aside>
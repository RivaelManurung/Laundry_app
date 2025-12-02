<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1', 
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-900 antialiased font-sans">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden transition-all duration-300">
            
            @include('layouts.partials.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 lg:p-8">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        @yield('header-title', 'Dashboard')
                    </h1>
                </div>

                @yield('content')
            </main>

        </div>
    </div>

    <div class="fixed top-4 right-4 z-[9999] flex flex-col gap-3 pointer-events-none">
        
        @if (session()->has('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="pointer-events-auto w-full max-w-xs sm:max-w-sm rounded-xl bg-white shadow-2xl border border-gray-100 flex items-start gap-3 p-4">
                
                <div class="flex-shrink-0 mt-0.5">
                    <div class="h-8 w-8 rounded-full bg-green-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-bold text-gray-900">Berhasil</h3>
                    <p class="mt-1 text-sm text-gray-600 leading-relaxed">{{ session('success') }}</p>
                </div>

                <button @click="show = false" class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-500 focus:outline-none transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session()->has('error') || $errors->any())
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 6000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="pointer-events-auto w-full max-w-xs sm:max-w-sm rounded-xl bg-white shadow-2xl border border-gray-100 flex items-start gap-3 p-4">
                
                <div class="flex-shrink-0 mt-0.5">
                    <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-bold text-gray-900">Gagal</h3>
                    <div class="mt-1 text-sm text-gray-600 leading-relaxed">
                        @if(session()->has('error'))
                            {{ session('error') }}
                        @else
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <button @click="show = false" class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-500 focus:outline-none transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        @endif

    </div>

</body>
</html>
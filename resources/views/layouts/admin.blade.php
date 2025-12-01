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
        /* Menggunakan Font Jakarta Sans agar beda dari Inter (Filament default) */
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Mengganti warna utama menjadi Indigo (Kebiruan/Ungu)
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

<body class="bg-gray-100 text-gray-900 antialiased">

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

</body>
</html>
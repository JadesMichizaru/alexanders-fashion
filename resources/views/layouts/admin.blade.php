<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alexanders Fashion') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Sidebar Navigation -->
        <aside
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 transform bg-indigo-900 lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex items-center justify-center h-16 bg-indigo-1000">
                <span class="text-xl font-bold text-white uppercase tracking-wider">AF Admin</span>
            </div>

            <nav class="mt-5 px-4 space-y-2 overflow-y-auto h-[calc(100vh-64px)]">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2 text-xs font-semibold text-indigo-400 uppercase">Management</div>

                <a href="{{ route('products.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Produk
                </a>

                <a href="{{ route('admin.stock.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.stock.*') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Stok
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Pesanan
                </a>

                <div class="pt-4 pb-2 text-xs font-semibold text-indigo-400 uppercase">Laporan</div>

                <a href="{{ route('admin.reports.financial') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Laporan Keuangan
                </a>

                <a href="{{ route('admin.expenses.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.expenses.*') ? 'bg-indigo-700 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Pengeluaran
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 border-indigo-100">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="relative mx-4 lg:mx-0">
                        <h2 class="text-xl font-semibold text-gray-800">Panel Admin</h2>
                    </div>
                </div>

                <div class="flex items-center">
                    <!-- User Configuration Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none">
                            <span class="mr-2 text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                            <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                             class="absolute right-0 w-48 mt-2 bg-white rounded-md shadow-xl z-20 overflow-hidden border">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

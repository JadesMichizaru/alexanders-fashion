<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - {{ config('app.name') }}</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome untuk icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-indigo-800 text-white w-64 py-6 px-4 hidden md:block">
            <div class="mb-8 px-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-indigo-200 text-sm mt-1">v1.0.0</p>
            </div>

            <nav class="space-y-1">
                <a href="#" class="flex items-center px-4 py-3 bg-indigo-900 rounded-lg text-white">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Products</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Accounts</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span>Views</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span>Sales</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out font-medium">Logout</button>

                </form>

            </nav>

            <div class="absolute bottom-0 left-0 w-64 p-4">
                <div class="bg-indigo-900 rounded-lg p-4">
                    <p class="text-xs text-indigo-200">Logged in as:</p>
                    <p class="font-medium text-sm truncate">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </aside>

        <!-- Mobile menu button (hidden on desktop) -->
        <div class="md:hidden fixed top-0 left-0 p-4 z-10">
            <button class="text-gray-600 focus:outline-none" onclick="toggleSidebar()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-8">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">{{ "Welcome, " . Auth::user()->name . "!" }}</h2>
                <p class="text-gray-600 mt-1">Here's what's happening with your store today.</p>
            </div>

            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Stock Card -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Total Stock</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalStock ?? 0 }}</p>
                            <p class="text-green-500 text-sm mt-2">
                                <i class="fas fa-arrow-up mr-1"></i> +2.5% from last month
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-boxes text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Accounts Card -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Total Accounts</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $users_id ?? 0 }}</p>
                            <p class="text-green-500 text-sm mt-2">
                                <i class="fas fa-arrow-up mr-1"></i> +5 new this week
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-users text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Views Card -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Total Views</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalViews ?? 0 }}</p>
                            <p class="text-yellow-500 text-sm mt-2">
                                <i class="fas fa-minus mr-1"></i> -1.2% from yesterday
                            </p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-eye text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Sales This Month Card -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Sales This Month</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $salesThisMonth ?? 0 }}</p>
                            <p class="text-green-500 text-sm mt-2">
                                <i class="fas fa-arrow-up mr-1"></i> +12.5% from last month
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <i class="fas fa-shopping-cart text-yellow-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Sales Chart -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Weekly Sales</h3>
                    <div class="h-64 flex items-end justify-between space-x-2">
                        @php
                            $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                            $maxSale = 5000000; // Contoh maksimal 5 juta
                        @endphp

                        @foreach($days as $index => $day)
                            @php
                                // Data dummy, nanti bisa diganti dengan data real
                                $height = rand(30, 100);
                            @endphp
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-full bg-indigo-100 rounded-t-lg relative" style="height: 160px;">
                                    <div class="absolute bottom-0 w-full bg-indigo-600 rounded-t-lg transition-all duration-500 hover:bg-indigo-700"
                                         style="height: {{ $height }}%;"></div>
                                </div>
                                <span class="text-xs text-gray-600 mt-2">{{ $day }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Top Products</h3>
                    <div class="space-y-4">
                        @php
                            $topProducts = [
                                ['name' => 'Product A', 'sales' => 45, 'color' => 'blue'],
                                ['name' => 'Product B', 'sales' => 32, 'color' => 'green'],
                                ['name' => 'Product C', 'sales' => 28, 'color' => 'purple'],
                                ['name' => 'Product D', 'sales' => 21, 'color' => 'yellow'],
                                ['name' => 'Product E', 'sales' => 15, 'color' => 'red'],
                            ];
                        @endphp

                        @foreach($topProducts as $product)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-gray-700">{{ $product['name'] }}</span>
                                    <span class="text-gray-600">{{ $product['sales'] }} sales</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-{{ $product['color'] }}-600 h-2 rounded-full"
                                         style="width: {{ $product['sales'] * 2 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Sales Table -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Sales</h3>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $recentSales = [
                                    ['inv' => 'INV-001', 'product' => 'Product A', 'customer' => 'John Doe', 'date' => '2024-01-15', 'amount' => 150000, 'status' => 'completed'],
                                    ['inv' => 'INV-002', 'product' => 'Product B', 'customer' => 'Jane Smith', 'date' => '2024-01-14', 'amount' => 275000, 'status' => 'completed'],
                                    ['inv' => 'INV-003', 'product' => 'Product C', 'customer' => 'Bob Johnson', 'date' => '2024-01-14', 'amount' => 420000, 'status' => 'pending'],
                                    ['inv' => 'INV-004', 'product' => 'Product A', 'customer' => 'Alice Brown', 'date' => '2024-01-13', 'amount' => 189000, 'status' => 'completed'],
                                    ['inv' => 'INV-005', 'product' => 'Product D', 'customer' => 'Charlie Wilson', 'date' => '2024-01-13', 'amount' => 560000, 'status' => 'cancelled'],
                                ];
                            @endphp

                            @foreach($recentSales as $sale)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sale['inv'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sale['product'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sale['customer'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sale['date'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($sale['amount'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColor = match($sale['status']) {
                                            'completed' => 'green',
                                            'pending' => 'yellow',
                                            'cancelled' => 'red',
                                            default => 'gray'
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                        {{ ucfirst($sale['status']) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </main>
    </div>

    <!-- JavaScript for mobile sidebar -->
    <script>
        function toggleSidebar() {
            // Implementasi toggle sidebar untuk mobile
            alert('Sidebar toggle untuk mobile - bisa diimplementasikan dengan JavaScript');
        }
    </script>
</body>
</html>

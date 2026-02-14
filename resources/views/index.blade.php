<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Aplikasi Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a class="text-xl font-bold text-blue-600" href="/">Aplikasi Saya</a>
            <div class="md:flex hidden items-center space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-500 transition">Dashboard Admin</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-500 transition font-semibold">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500 transition">Register</a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 transition">Login</a>
                @endauth
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
            <ul class="flex flex-col space-y-2">
                @auth
                    <li>
                        <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-blue-500 transition">Dashboard Admin</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block text-gray-700 hover:text-red-500 transition font-semibold w-full text-left">Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('register') }}" class="block text-gray-700 hover:text-blue-500 transition">Register</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-500 transition">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
        <script>
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white text-center py-20">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg">Welcome to my demo project website</h1>
            <p class="text-lg md:text-xl mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            <a href="#produk" class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-gray-200 transition">
                Lihat Produk
            </a>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Produk Unggulan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                {{--
                Contoh penggunaan data produk:
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                            <div class="card-footer">
                                <strong>Rp {{ number_format($product->price,0,',','.') }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
                --}}
                <!-- Sementara tampilkan contoh statis -->
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6 flex flex-col">
                    <img src="https://via.placeholder.com/300x200" class="rounded-lg mb-4 w-full object-cover h-48" alt="Produk 1">
                    <h5 class="font-bold text-xl text-gray-800 mb-2">Nama Produk 1</h5>
                    <p class="text-gray-600 flex-1">Deskripsi singkat produk 1.</p>
                    {{-- <div class="mt-4">
                        <span class="font-semibold text-blue-600 text-lg">Rp 99.000</span>
                    </div> --}}
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6 flex flex-col">
                    <img src="https://via.placeholder.com/300x200" class="rounded-lg mb-4 w-full object-cover h-48" alt="Produk 2">
                    <h5 class="font-bold text-xl text-gray-800 mb-2">Nama Produk 2</h5>
                    <p class="text-gray-600 flex-1">Deskripsi singkat produk 2.</p>
                    {{-- <div class="mt-4">
                        <span class="font-semibold text-blue-600 text-lg">Rp 125.000</span>
                    </div> --}}
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6 flex flex-col">
                    <img src="https://via.placeholder.com/300x200" class="rounded-lg mb-4 w-full object-cover h-48" alt="Produk 3">
                    <h5 class="font-bold text-xl text-gray-800 mb-2">Nama Produk 3</h5>
                    <p class="text-gray-600 flex-1">Deskripsi singkat produk 3.</p>
                    {{-- <div class="mt-4">
                        <span class="font-semibold text-blue-600 text-lg">Rp 140.000</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Tentang Kami</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto">
                Aplikasi kami berfokus untuk menyediakan berbagai produk pilihan berkualitas dengan harga terbaik.
            </p>
        </div>
    </section>

    <footer class="bg-gray-800 text-gray-200 py-6 text-center">
        &copy; {{ date('Y') }} <span class="font-semibold">Aplikasi Saya</span>. All rights reserved.
    </footer>
</body>
</html>

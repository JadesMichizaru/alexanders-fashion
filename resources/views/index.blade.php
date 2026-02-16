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
            <p class="text-lg md:text-xl mb-8">Temukan berbagai produk pilihan dengan kualitas terbaik dan harga terjangkau</p>
            <a href="#produk" class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-gray-200 transition">
                Lihat Produk
            </a>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Produk Unggulan</h2>
            <p class="text-center text-gray-600 mb-10">Koleksi produk terbaik kami untuk Anda</p>

            @if(isset($products) && $products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                            <!-- Gambar Produk -->
                            <div class="relative h-56 overflow-hidden bg-gray-200">
                                @if($product->image)
                                    <img src="{{ asset('storage/products/hermès-cashmere-and-silk-poncho.jpg' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Badge Stok -->
                                @if($product->stock > 0)
                                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        Stok: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Detail Produk -->
                            <div class="p-5">
                                <h3 class="font-bold text-xl text-gray-800 mb-2 line-clamp-1">{{ $product->name }}</h3>

                                <!-- Kategori dan Info Tambahan -->
                                <div class="flex items-center gap-2 mb-3">
                                    @if($product->category)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $product->category }}
                                        </span>
                                    @endif
                                    @if($product->size)
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            Size: {{ $product->size }}
                                        </span>
                                    @endif
                                    @if($product->color)
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $product->color }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Deskripsi -->
                                @if($product->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                                @endif

                                <!-- Harga dan Stok -->
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-2xl text-blue-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>

                                    <!-- Indikator Stok -->
                                    <div class="text-right">
                                        @if($product->stock > 10)
                                            <span class="text-xs text-green-600 font-semibold">
                                                <i class="fas fa-check-circle mr-1"></i>Tersedia
                                            </span>
                                        @elseif($product->stock > 0)
                                            <span class="text-xs text-yellow-600 font-semibold">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Sisa {{ $product->stock }}
                                            </span>
                                        @else
                                            <span class="text-xs text-red-600 font-semibold">
                                                <i class="fas fa-times-circle mr-1"></i>Stok Habis
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($products, 'links'))
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif

            @else
                <!-- Tampilkan produk statis jika tidak ada produk di database -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Produk Statis 1 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-5">
                        <img src="https://via.placeholder.com/300x200/FF6B6B/FFFFFF?text=Baju+Keren"
                             class="rounded-lg mb-4 w-full object-cover h-48"
                             alt="Produk 1">
                        <h5 class="font-bold text-xl text-gray-800 mb-2">Kemeja Flanel Premium</h5>
                        <p class="text-gray-600 text-sm mb-3">Kemeja flanel bahan nyaman, cocok untuk santai maupun formal</p>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-blue-600 text-xl">Rp 149.000</span>
                            <span class="text-xs text-green-600 font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>Stok: 15
                            </span>
                        </div>
                    </div>

                    <!-- Produk Statis 2 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-5">
                        <img src="https://via.placeholder.com/300x200/4ECDC4/FFFFFF?text=Celana+Jeans"
                             class="rounded-lg mb-4 w-full object-cover h-48"
                             alt="Produk 2">
                        <h5 class="font-bold text-xl text-gray-800 mb-2">Celana Jeans Slim Fit</h5>
                        <p class="text-gray-600 text-sm mb-3">Celana jeans premium dengan bahan stretch, nyaman dipakai sehari-hari</p>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-blue-600 text-xl">Rp 189.000</span>
                            <span class="text-xs text-green-600 font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>Stok: 8
                            </span>
                        </div>
                    </div>

                    <!-- Produk Statis 3 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-5">
                        <img src="https://via.placeholder.com/300x200/FFE66D/000000?text=Jaket+Hoodie"
                             class="rounded-lg mb-4 w-full object-cover h-48"
                             alt="Produk 3">
                        <h5 class="font-bold text-xl text-gray-800 mb-2">Jaket Hoodie Kekinian</h5>
                        <p class="text-gray-600 text-sm mb-3">Jaket hoodie dengan bahan fleece, hangat dan nyaman untuk cuaca dingin</p>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-blue-600 text-xl">Rp 225.000</span>
                            <span class="text-xs text-yellow-600 font-semibold">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Sisa 3
                            </span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8 text-gray-500">
                    <p>Belum ada produk di database. Menampilkan produk contoh.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Tentang Kami</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto">
                Aplikasi kami berfokus untuk menyediakan berbagai produk pilihan berkualitas dengan harga terbaik.
                Kami selalu berusaha memberikan pengalaman berbelanja yang nyaman dan aman untuk pelanggan.
            </p>

            <!-- Statistik Sederhana -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto mt-10">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">
                        @if(isset($products))
                            {{ $products->count() }}+
                        @else
                            50+
                        @endif
                    </div>
                    <div class="text-gray-600">Produk Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">
                        @if(isset($totalStock))
                            {{ number_format($totalStock) }}
                        @else
                            1000+
                        @endif
                    </div>
                    <div class="text-gray-600">Total Stok</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">100%</div>
                    <div class="text-gray-600">Kepuasan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-6 text-center">
        &copy; {{ date('Y') }} <span class="font-semibold">Aplikasi Saya</span>. All rights reserved.
    </footer>

    <!-- Optional: Font Awesome untuk ikon -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html>

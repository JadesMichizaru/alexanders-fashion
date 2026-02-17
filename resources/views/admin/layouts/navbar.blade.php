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
            <a href="{{ route('index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                <i class="fas fa-globe w-5 h-5 mr-3"></i>
                <span>Demo Website</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                <i class="fas fa-box w-5 h-5 mr-3"></i>
                <span>Products</span>
            </a>
            <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition">
                <i class="fas fa-users w-5 h-5 mr-3"></i>
                <span>Profile</span>
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

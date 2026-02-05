<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
    <div class="w-full max-w-md bg-white/80 dark:bg-gray-900/80 rounded-2xl shadow-xl px-8 py-10 backdrop-blur-md">
        {{-- Session Status / Error --}}
        @if(session('status'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded text-sm text-center">
            {{ session('status') }}
        </div>
        @endif
        @if($errors->any())
        <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded text-sm text-center">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Please Register First!</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Register your account to continue</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
@csrf
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm mb-1 font-medium text-gray-700 dark:text-gray-200">Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 shadow-sm px-3 py-2 text-gray-800 dark:text-white transition">
                @error('name')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
                @enderror
            </div>
            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-sm mb-1 font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 shadow-sm px-3 py-2 text-gray-800 dark:text-white transition">
                @error('email')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm mb-1 font-medium text-gray-700 dark:text-gray-200">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 shadow-sm px-3 py-2 text-gray-800 dark:text-white transition">
                @error('password')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm mb-1 font-medium text-gray-700 dark:text-gray-200">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="current-password"
                    class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 shadow-sm px-3 py-2 text-gray-800 dark:text-white transition">
                @error('password_confirmation')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center">
                <input
                    id="remember_me"
                    name="remember"
                    type="checkbox"
                    class="rounded focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:bg-gray-900 dark:border-gray-700 text-indigo-600 shadow-sm">
                <label for="remember_me" class="ml-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer hover:text-indigo-700 dark:hover:text-indigo-400 transition">
                    Remember me
                </label>
            </div>

            {{-- Social Login - Google Login Option - Google Login Option --}}
            <div>
                <a href="{{ route('google.redirect') }}"
                    class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-2 px-4 rounded-xl shadow transition duration-200 hover:shadow-lg active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google Icon">
                    Login with Google
                </a>
            </div>

            {{-- Actions: Register & Forgot Password --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline hover:text-indigo-700 dark:hover:text-indigo-300 transition">
                    Already Have?
                </a>
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-300 transition focus:outline-none" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
                @endif
            </div>

            {{-- Login Button --}}
            <div>
                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-bold rounded-xl shadow-lg transition hover:from-indigo-700 hover:to-pink-700 hover:-translate-y-1 active:scale-95 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>

</html>
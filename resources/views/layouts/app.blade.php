<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Movia') }}</title>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-900 text-white min-h-screen antialiased flex flex-col">

    <!-- ✅ Header -->
    <header class="flex justify-between items-center p-4 bg-gray-800 shadow-md">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold flex items-center space-x-2">
            <i class="fas fa-film text-purple-400"></i>
            <span>{{ config('app.name', 'Movia') }}</span>
        </a>

        <!-- Navigation & Search -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('movies.index') }}" class="hover:text-yellow-400">Browse Movies</a>

            <!-- Search -->
            <form method="GET" action="{{ route('movies.index') }}" class="flex items-center space-x-2">
                <input type="text" name="query" placeholder="Search movies..." 
                    class="px-3 py-1 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    value="{{ request('query') }}">
                <button type="submit"
                    class="bg-yellow-500 text-black px-3 py-1 rounded-md hover:bg-yellow-400">
                    Search
                </button>
            </form>

            <!-- ✅ User Dropdown or Guest Links -->
            @auth
            <!-- ✅ Dropdown Menu -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = ! open"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-20">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <!-- Guest Links -->
            <div class="flex space-x-2">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-500 rounded hover:bg-yellow-400">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Register</a>
            </div>
            @endauth
        </div>
    </header>

    <!-- ✅ Main Content -->
    <main class="flex-grow p-6 w-full max-w-7xl mx-auto">
        @yield('content')
    </main>

    <!-- ✅ Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p class="text-sm">Follow us:</p>
            <div class="flex justify-center space-x-6 mt-2 text-lg">
                <a href="#" class="hover:text-blue-500"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-pink-400"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>

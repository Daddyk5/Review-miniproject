<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Movia') }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTcBNzS2eNbUs+N9VgZsv5FirefoxYeD1yfknhk+aoCA8DmFumiQJ5AZt0pOEtpjdbc/YWZLxE+nobw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind & AlpineJS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-900 text-white antialiased min-h-screen flex flex-col justify-center items-center">

    <!-- Logo / Home Link -->
    <div class="mb-8 text-center">
        <a href="{{ route('home') }}" class="text-3xl font-bold text-yellow-400 hover:text-yellow-500 transition duration-300">
            <i class="fas fa-film"></i> {{ config('app.name', 'Movia') }}
        </a>
        <p class="mt-2 text-gray-400 text-sm">Discover, Review & Rate Movies like IMDb</p>
    </div>

    <!-- Main Card Wrapper -->
    <div class="w-full sm:max-w-md px-8 py-6 bg-gray-800 border border-gray-700 shadow-lg rounded-lg">
        <!-- Inject Form Content (Login/Register/Forgot Password) -->
        @yield('content')
    </div>

    <!-- Footer (Optional) -->
    <footer class="mt-6 text-sm text-gray-500 text-center">
        &copy; {{ date('Y') }} {{ config('app.name', 'Movia') }}. All rights reserved.
    </footer>

</body>
</html>

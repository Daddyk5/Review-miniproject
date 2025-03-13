@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white px-4">
    <h1 class="text-3xl font-bold mb-6">🎬 Login to Movia</h1>

    <form method="POST" action="{{ route('login') }}" class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block mb-2">Password</label>
            <input type="password" name="password" required class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="remember" class="mr-2" />
            <label>Remember me</label>
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-black p-2 rounded">Login</button>

        <p class="mt-4 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="underline text-yellow-400">Register here</a>
        </p>

        <p class="mt-2 text-center">
            <a href="{{ route('password.request') }}" class="underline text-yellow-400">Forgot Password?</a>
        </p>
    </form>

    {{-- Social Login --}}
    <div class="flex justify-center gap-4 mt-6">
        <a href="{{ route('social.redirect', 'google') }}" class="bg-red-600 p-2 px-4 rounded text-white">Google</a>
        <a href="{{ route('social.redirect', 'facebook') }}" class="bg-blue-600 p-2 px-4 rounded text-white">Facebook</a>
        <a href="{{ route('social.redirect', 'github') }}" class="bg-gray-800 p-2 px-4 rounded text-white">GitHub</a>
    </div>
</div>
@endsection

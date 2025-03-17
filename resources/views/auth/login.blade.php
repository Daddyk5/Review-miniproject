@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white px-4">
    <h1 class="text-3xl font-bold mb-6">🎬 Login to Movia</h1>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block mb-1">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-2">
            <input type="checkbox" id="remember" name="remember" class="mr-2">
            <label for="remember" class="text-sm">Remember me</label>
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black p-2 rounded">
            Login
        </button>

        <!-- Forgot Password & Register Links -->
        <div class="text-center mt-4 space-y-2">
            <p>
                Don't have an account? 
                <a href="{{ route('register') }}" class="underline text-yellow-400">Register here</a>
            </p>
            <p>
                <a href="{{ route('password.request') }}" class="underline text-yellow-400">Forgot Password?</a>
            </p>
        </div>
    </form>
</div>
@endsection

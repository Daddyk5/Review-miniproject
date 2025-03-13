@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white">
    <h1 class="text-3xl font-bold mb-6">🎬 Join MovieHub</h1>

    <form method="POST" action="{{ route('register') }}" class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus 
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block mb-2">Password</label>
            <input type="password" name="password" required 
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" />
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-black p-2 rounded">Register</button>

        <!-- Already have an account? -->
        <p class="mt-4 text-center">
            Already have an account? <a href="{{ route('login') }}" class="underline text-yellow-400">Login here</a>
        </p>

        <!-- Social Login -->
        <div class="flex justify-center gap-4 mt-4">
            <a href="{{ route('social.redirect', 'google') }}" class="btn btn-danger">
                <i class="fab fa-google"></i> Google
            </a>
            <a href="{{ route('social.redirect', 'facebook') }}" class="btn btn-primary">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="{{ route('social.redirect', 'github') }}" class="btn btn-dark">
                <i class="fab fa-github"></i> GitHub
            </a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.guest')

@section('content')
<div class="space-y-6">

    <!-- Header / Info -->
    <div class="text-center">
        <h2 class="text-2xl font-bold mb-2">🔑 Forgot Password</h2>
        <p class="text-gray-400">Enter your email address and we'll send you a link to reset your password.</p>
    </div>

    <!-- Forgot Password Form -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Field -->
        <div>
            <label for="email" class="block mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" placeholder="you@example.com">

            <!-- Error Message -->
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded transition">
            Send Password Reset Link
        </button>
    </form>

    <!-- Back to Login Link -->
    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="underline text-yellow-400 hover:text-yellow-500">← Back to Login</a>
    </div>

</div>
@endsection

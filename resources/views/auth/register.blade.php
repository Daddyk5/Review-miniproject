@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white px-4">
    <h1 class="text-3xl font-bold mb-6">🎬 Join MovieHub</h1>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block mb-1">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-1">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block mb-1">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" />
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full bg-yellow-500 text-black p-2 rounded hover:bg-yellow-400">Register</button>

        <!-- Already have an account -->
        <p class="mt-4 text-center text-gray-400">
            Already have an account? <a href="{{ route('login') }}" class="underline text-yellow-400">Login here</a>
        </p>
    </form>
</div>
@endsection

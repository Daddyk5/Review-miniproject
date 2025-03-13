@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block mb-2">Name</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" required
                   class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:ring focus:ring-yellow-500">

            @error('name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email (Readonly for now if you don't want it to be updated, otherwise remove readonly) -->
        <div>
            <label for="email" class="block mb-2">Email</label>
            <input id="email" name="email" value="{{ old('email', $user->email) }}" readonly
                   class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-gray-400">
        </div>

        <!-- Profile Photo Upload -->
        <div>
            <label class="block mb-2">Profile Photo</label>
            <input type="file" name="profile_photo"
                   class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white">

            @error('profile_photo')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            @if($user->profile_photo_path)
                <div class="mt-4 flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" class="w-24 h-24 rounded-full border border-gray-600">
                    <p class="text-sm text-gray-400">Current Profile Picture</p>
                </div>
            @endif
        </div>

        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded">
            Save Changes
        </button>
    </form>
</div>
@endsection

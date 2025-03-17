@extends('layouts.admin')

@section('content')
<div class="container py-8">

    {{-- Page Title --}}
    <h1 class="text-3xl font-bold mb-6 text-white">🎬 Add New Movie</h1>

    {{-- Movie Create Form --}}
    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Movie Title --}}
        <div>
            <label for="title" class="block text-white mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" 
                   class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500"
                   value="{{ old('title') }}" placeholder="Enter movie title..." required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Movie Description --}}
        <div>
            <label for="description" class="block text-white mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500"
                      placeholder="Write a brief description...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Movie Poster Upload --}}
        <div>
            <label for="poster" class="block text-white mb-1">Poster Image (JPG, WEBP, PNG)</label>
            <input type="file" name="poster" id="poster"
                   class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500"
                   accept="image/png, image/jpeg, image/webp">
            @error('poster')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Movie Genres --}}
        <div>
            <label for="genres" class="block text-white mb-1">Select Genres <span class="text-red-500">*</span></label>
            <select name="genres[]" id="genres" multiple
                    class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ (collect(old('genres'))->contains($genre->id)) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-gray-400 mt-1 text-sm">Hold CTRL (Windows) or CMD (Mac) to select multiple genres.</p>
            @error('genres')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Action Buttons --}}
        <div class="flex space-x-4 pt-4">
            <button type="submit"
                class="bg-yellow-500 text-black px-6 py-2 rounded hover:bg-yellow-600 transition font-semibold">
                Add Movie
            </button>
            <a href="{{ route('admin.movies.index') }}"
               class="text-gray-400 hover:text-white underline transition">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection

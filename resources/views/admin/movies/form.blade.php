@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 p-8 rounded-lg shadow-md border border-gray-800">
    <h1 class="text-4xl font-bold mb-8 text-white text-center">🎬 Add New Movie</h1>

    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-gray-300 mb-2 font-semibold">🎬 Movie Title</label>
            <input type="text" name="title" id="title"
                   class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-white focus:ring focus:ring-yellow-500"
                   value="{{ old('title') }}" required placeholder="Enter movie title...">
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-gray-300 mb-2 font-semibold">📝 Description</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-white focus:ring focus:ring-yellow-500"
                      placeholder="Write a brief description...">{{ old('description') }}</textarea>
        </div>

        {{-- Poster Upload --}}
        <div>
            <label for="poster" class="block text-gray-300 mb-2 font-semibold">🖼 Poster Image (JPG, WEBP, PNG)</label>
            <input type="file" name="poster" id="poster"
                   class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-white focus:ring focus:ring-yellow-500"
                   accept="image/png, image/jpeg, image/webp">
            <p class="text-gray-400 mt-2 text-sm">Recommended size: 300x450px</p>
        </div>

        {{-- Genres --}}
        <div>
            <label for="genres" class="block text-gray-300 mb-2 font-semibold">🎭 Select Genres</label>
            <select name="genres[]" id="genres" multiple
                    class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-white h-40 focus:ring focus:ring-yellow-500">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ (collect(old('genres'))->contains($genre->id)) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-gray-400 mt-2 text-sm">Hold <strong>CTRL</strong> (Windows) or <strong>CMD</strong> (Mac) to select multiple genres.</p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-between items-center pt-6">
            <a href="{{ route('admin.movies.index') }}"
               class="text-gray-400 hover:text-yellow-400 transition duration-200 underline">
                Cancel
            </a>
            <button type="submit"
                    class="bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-200 font-semibold">
                ➕ Add Movie
            </button>
        </div>
    </form>
</div>
@endsection

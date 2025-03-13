@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">🎬 All Movies</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($movies as $movie)
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-yellow-400">{{ $movie->title }}</h3>
                <p class="text-gray-400 mt-2">{{ Str::limit($movie->description, 100) }}</p>
                <a href="{{ route('movies.show', $movie) }}" class="inline-block mt-4 bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-400">View Details</a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $movies->links() }}
    </div>
</div>
@endsection

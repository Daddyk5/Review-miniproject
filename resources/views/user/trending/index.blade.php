@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">🔥 Trending Movies</h1>

    @if($trendingMovies->count())
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($trendingMovies as $movie)
                <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-400">Rating: ⭐ {{ $movie->average_rating }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No trending movies available.</p>
    @endif
@endsection

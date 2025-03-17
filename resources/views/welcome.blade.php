@extends('layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen text-white">

    {{-- ✅ Hero Section --}}
    <section class="relative bg-cover bg-center h-[500px] flex items-center justify-center"
        style="background-image: url('https://source.unsplash.com/1600x900/?cinema,movie');">
        <div class="bg-black bg-opacity-70 p-8 rounded-lg text-center max-w-2xl mx-auto">
            <h1 class="text-5xl font-bold mb-4">🎬 Movia</h1>
            <p class="text-lg mb-6">Discover, Review & Rate Movies like IMDB</p>
            <a href="{{ route('movies.index') }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded shadow-lg">
                Browse Movies
            </a>
        </div>
    </section>

    {{-- ✅ Trending Movies Section --}}
    <section class="py-16 max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-10 text-center">🔥 Trending Movies</h2>

        @if($trendingMovies->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($trendingMovies as $movie)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold truncate">{{ $movie->title }}</h3>
                        <p class="text-sm mt-1">⭐ {{ number_format($movie->average_rating, 1) }}/5</p>
                        <a href="{{ route('movies.show', $movie) }}"
                           class="block mt-4 text-center bg-yellow-500 text-black py-2 rounded hover:bg-yellow-600">
                            View Movie
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-400">No trending movies available.</p>
        @endif
    </section>

    {{-- ✅ CTA for Guests --}}
    @guest
    <section class="py-16 bg-gray-800 text-center">
        <h3 class="text-2xl font-bold mb-4">Join MoviaVerse Today!</h3>
        <p class="mb-6">Create your free account and start reviewing your favorite movies!</p>
        <a href="{{ route('register') }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">
            Get Started
        </a>
    </section>
    @endguest

    {{-- ✅ Recommended Movies for Logged-in Users --}}
    @auth
    <section class="py-16 max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-10 text-center">🎭 Recommended for You</h2>

        @if($recommendedMovies->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($recommendedMovies as $movie)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold truncate">{{ $movie->title }}</h3>
                        <p class="text-sm mt-1">⭐ {{ number_format($movie->average_rating, 1) }}/5</p>
                        <a href="{{ route('movies.show', $movie) }}"
                           class="block mt-4 text-center bg-yellow-500 text-black py-2 rounded hover:bg-yellow-600">
                            View Movie
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-400">No recommendations yet. Rate some movies to get suggestions!</p>
        @endif
    </section>
    @endauth

    {{-- ✅ Latest Reviews Section --}}
    <section class="py-16 max-w-5xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-10 text-center">📝 Latest Reviews</h2>

        @if($recentReviews->count())
        <div class="space-y-6">
            @foreach($recentReviews as $review)
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <p class="font-bold text-lg">{{ $review->user->name }}</p>
                    <p class="text-yellow-400">⭐ {{ $review->rating }}/5</p>
                </div>
                <p class="italic text-gray-300 mt-2">"{{ Str::limit($review->content, 120) }}"</p>
                <a href="{{ route('movies.show', $review->movie) }}" class="text-yellow-400 hover:text-yellow-300 mt-2 block text-right text-sm">
                    Read Full Review →
                </a>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-400">No recent reviews available.</p>
        @endif
    </section>

    {{-- ✅ Footer --}}
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p class="mb-2">Follow us on:</p>
        <div class="flex justify-center space-x-6">
            <a href="https://facebook.com/yourpage" class="hover:text-blue-500 text-lg">🔵 Facebook</a>
            <a href="https://twitter.com/yourpage" class="hover:text-blue-400 text-lg">🔷 Twitter</a>
            <a href="https://instagram.com/yourpage" class="hover:text-pink-500 text-lg">🟣 Instagram</a>
        </div>
        <p class="mt-4 text-gray-400 text-sm">© {{ date('Y') }} Movia. All rights reserved.</p>
    </footer>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="relative bg-gray-900 min-h-screen text-white">

    {{-- Hero Section --}}
    <section class="relative bg-cover bg-center h-[400px] flex items-center justify-center" style="background-image: url('https://source.unsplash.com/1600x900/?cinema,movie');">
        <div class="bg-black bg-opacity-70 p-10 rounded-lg text-center">
            <h1 class="text-4xl font-bold mb-4">🎬 Movia</h1>
            <p class="text-lg mb-6">Discover, Review & Rate Movies like IMDB</p>
            <a href="{{ route('movies.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">Browse Movies</a>
        </div>
    </section>

    {{-- Trending Movies --}}
    <section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8">🔥 Trending Movies</h2>

        @if($movies->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold truncate">{{ $movie->title }}</h3>
                    <p class="mt-2 text-sm">⭐ {{ number_format($movie->average_rating, 1) }}/5</p>
                    <a href="{{ route('movies.show', $movie) }}" class="inline-block mt-4 bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">View</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-400">No trending movies available.</p>
        @endif
    </section>

    <footer class="bg-gray-800 text-white py-6 text-center">
     <p>Follow us on:</p>
        <div class="flex justify-center space-x-4 mt-3">
        <a href="https://facebook.com/yourpage" class="text-blue-500 text-xl">🔵 Facebook</a>
        <a href="https://twitter.com/yourpage" class="text-blue-400 text-xl">🔷 Twitter</a>
        <a href="https://instagram.com/yourpage" class="text-pink-500 text-xl">🟣 Instagram</a>
      </div>
    </footer>


    {{-- CTA Section for Guests --}}
    @guest
    <section class="py-16 bg-gray-800 text-center">
        <h3 class="text-2xl font-bold mb-4">Join MoviaVerse Today!</h3>
        <p class="mb-6">Create your account to start reviewing and rating movies.</p>
        <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">Get Started</a>
    </section>
    @endguest

</div>
@endsection

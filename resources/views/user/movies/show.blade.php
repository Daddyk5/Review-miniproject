@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-yellow-400">{{ $movie->title }}</h1>
    <p class="text-gray-400 mt-4">{{ $movie->description }}</p>

    <div class="mt-4">
        <strong>Genres:</strong>
        @foreach($movie->genres as $genre)
            <span class="bg-gray-700 text-white px-2 py-1 rounded">{{ $genre->name }}</span>
        @endforeach
    </div>

    <hr class="my-6 border-gray-600">

    <h2 class="text-2xl font-semibold mb-4">⭐ Reviews</h2>

    @auth
        <form action="{{ route('movies.reviews.store', $movie) }}" method="POST" class="mb-6">
            @csrf
            <textarea name="content" rows="3" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600" placeholder="Write a review..." required></textarea>
            <button type="submit" class="mt-2 bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-400">Submit Review</button>
        </form>
    @endauth

    @if($movie->reviews->count())
        @foreach ($movie->reviews as $review)
            <div class="bg-gray-800 p-4 rounded-lg shadow mb-4">
                <p class="text-white">{{ $review->content }}</p>
                <p class="text-gray-500 text-sm mt-2">By {{ $review->user->name }}</p>
            </div>
        @endforeach
    @else
        <p class="text-gray-400">No reviews yet. Be the first to review!</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">⭐ Reviews for "{{ $movie->title }}"</h2>

    <!-- Add Review Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Add Your Review</h5>
            <form action="{{ route('reviews.store', $movie) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" rows="4" class="form-control" placeholder="Write your review here..." required></textarea>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" class="form-control w-25" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>

    <!-- Existing Reviews -->
    @if ($reviews->count())
        @foreach ($reviews as $review)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $review->user->name }} <small class="text-muted">rated {{ $review->rating }}/5</small></h5>
                    <p class="card-text">{{ $review->content }}</p>
                    <small class="text-muted">Reviewed on {{ $review->created_at->format('F j, Y') }}</small>
                    <div class="mt-2">
                        <a href="{{ route('user.comments', $review) }}" class="btn btn-sm btn-outline-primary">View Comments ({{ $review->comments->count() }})</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No reviews yet. Be the first to review this movie!</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">💬 Comments on Review by {{ $review->user->name }}</h2>
    <p><strong>Review:</strong> {{ $review->content }}</p>
    <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
    <p><small class="text-muted">Reviewed on {{ $review->created_at->format('F j, Y') }}</small></p>

    <!-- Add Comment Form -->
    <div class="card my-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Add a Comment</h5>
            <form action="{{ route('comments.store', $review) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" rows="3" class="form-control" placeholder="Write your comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    </div>

    <!-- Existing Comments -->
    @if ($comments->count())
        @foreach ($comments as $comment)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                    <small class="text-muted">Commented on {{ $comment->created_at->format('F j, Y') }}</small>
                </div>
            </div>
        @endforeach
    @else
        <p>No comments yet. Be the first to comment on this review!</p>
    @endif
</div>
@endsection

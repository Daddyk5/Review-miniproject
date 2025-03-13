@extends('layouts.admin')

@section('content')

<h1 class="fw-bold">⭐ Review Details</h1>

<div class="card p-4 bg-dark text-white">
    <h3><strong>Movie:</strong> {{ $review->movie->title }}</h3>
    <h4><strong>User:</strong> {{ $review->user->name }}</h4>
    <p><strong>Rating:</strong> {{ $review->rating }} ⭐</p>
    <p><strong>Comment:</strong> {{ $review->comment }}</p>
    <p><strong>Submitted At:</strong> {{ $review->created_at->format('M d, Y') }}</p>
</div>

<a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary mt-3">Back to Reviews</a>

@endsection

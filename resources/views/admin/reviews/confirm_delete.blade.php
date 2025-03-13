@extends('layouts.admin')

@section('content')

<h1 class="text-center fw-bold text-danger">⚠️ Confirm Deletion</h1>

<p>Are you sure you want to delete this review?</p>

<div class="card p-3 bg-dark text-white">
    <h4><strong>Movie:</strong> {{ $review->movie->title }}</h4>
    <h4><strong>User:</strong> {{ $review->user->name }}</h4>
    <p><strong>Comment:</strong> {{ $review->comment }}</p>
</div>

<form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="mt-3">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Yes, Delete</button>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection

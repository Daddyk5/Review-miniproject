@extends('layouts.admin')

@section('content')

<h1 class="fw-bold">✏️ Edit Review</h1>

<form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="bg-dark text-white p-4 rounded">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Rating:</label>
        <input type="number" name="rating" value="{{ $review->rating }}" min="1" max="5" class="form-control">
    </div>

    <div class="mb-3">
        <label>Comment:</label>
        <textarea name="comment" class="form-control" rows="4">{{ $review->comment }}</textarea>
    </div>

    <button type="submit" class="btn btn-warning">Update Review</button>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection

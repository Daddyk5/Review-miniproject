@extends('layouts.admin')

@section('content')
<div class="container py-5">

    <h1 class="fw-bold text-white mb-4">⭐ Review Details</h1>

    <div class="card bg-dark text-white p-4 shadow rounded-lg">
        {{-- 🎬 Movie --}}
        <h3 class="mb-3">
            <strong>🎬 Movie:</strong> 
            <span class="text-info">{{ $review->movie->title }}</span>
        </h3>

        {{-- 👤 User --}}
        <h4 class="mb-3">
            <strong>👤 User:</strong> 
            <span class="text-primary">{{ $review->user->name }}</span>
        </h4>

        {{-- ⭐ Rating with Stars --}}
        <p class="mb-3">
            <strong>⭐ Rating:</strong> 
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
            @endfor
            <span class="ms-2">({{ $review->rating }}/5)</span>
        </p>

        {{-- 📝 Review Content --}}
        <p class="mb-3">
            <strong>📝 Review:</strong> 
            <span class="text-light">{{ $review->content }}</span>
        </p>

        {{-- 📅 Date --}}
        <p class="mb-3">
            <strong>📅 Submitted At:</strong> 
            {{ $review->created_at->format('F j, Y') }}
        </p>

        {{-- 💬 Number of Comments --}}
        <p class="mb-3">
            <strong>💬 Comments:</strong> 
            {{ $review->comments->count() }}
            <a href="{{ route('admin.comments.index') }}" class="text-warning ms-2">(View All Comments)</a>
        </p>
    </div>

    {{-- 🔙 Back Button --}}
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary mt-4">⬅️ Back to Reviews</a>

</div>
@endsection

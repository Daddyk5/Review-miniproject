@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">

    <h2 class="text-3xl font-bold mb-6 text-white">⭐ Reviews for "{{ $movie->title }}"</h2>

    {{-- ✅ Add Review Form --}}
    <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold mb-4 text-yellow-400">Add Your Review</h3>
        <form action="{{ route('movies.reviews.store', $movie->id) }}" method="POST">
            @csrf

            {{-- ⭐ Rating Stars --}}
            <div class="mb-4">
                <label class="block text-white mb-2">Rating</label>
                <div class="flex space-x-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <label>
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 class="w-8 h-8 cursor-pointer star-fill text-gray-400 hover:text-yellow-400 transition"
                                 data-value="{{ $i }}">
                                <path fill="currentColor"
                                      d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.984 1.44 8.291L12 18.896l-7.376 4.688 1.44-8.291L.001 9.309l8.332-1.151z" />
                            </svg>
                        </label>
                    @endfor
                </div>
            </div>

            {{-- ✍️ Review Content --}}
            <div class="mb-4">
                <label for="content" class="block text-white mb-2">Review</label>
                <textarea name="content" rows="4" class="w-full p-3 bg-gray-700 rounded-lg text-white border border-gray-600"
                          placeholder="Write your review here..." required></textarea>
            </div>

            {{-- ✅ Submit --}}
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-black py-2 px-6 rounded-lg font-semibold w-full">
                Submit Review
            </button>
        </form>
    </div>

    {{-- ✅ Existing Reviews --}}
    @if ($reviews->count())
        @foreach ($reviews as $review)
            <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-xl font-bold text-white">{{ $review->user->name }}</h4>
                    {{-- ⭐ Rating Display --}}
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 class="w-6 h-6 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-500' }}">
                                <path fill="currentColor"
                                      d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.984 1.44 8.291L12 18.896l-7.376 4.688 1.44-8.291L.001 9.309l8.332-1.151z" />
                            </svg>
                        @endfor
                    </div>
                </div>

                {{-- 📝 Review Content --}}
                <p class="text-gray-300 mt-3">{{ $review->content }}</p>
                <small class="text-gray-500">Reviewed on {{ $review->created_at->format('F j, Y') }}</small>

                {{-- 💬 View Comments Link --}}
                <div class="mt-4">
                    <a href="{{ route('user.comments', $review->id) }}"
                       class="text-yellow-400 hover:text-yellow-300 font-semibold">
                        💬 View Comments ({{ $review->comments->count() }})
                    </a>
                </div>
            </div>
        @endforeach
    @else
        {{-- ❌ No Reviews Yet --}}
        <p class="text-gray-400 text-center">No reviews yet. Be the first to review this movie!</p>
    @endif
</div>

{{-- ✅ Optional Stars Fill JS (Optional if you want live preview) --}}
<script>
    const stars = document.querySelectorAll('.star-fill');
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const value = star.dataset.value;
            document.querySelectorAll('input[name="rating"]').forEach(radio => {
                if (radio.value == value) radio.checked = true;
            });
            stars.forEach((s, idx) => {
                s.classList.toggle('text-yellow-400', idx < value);
                s.classList.toggle('text-gray-400', idx >= value);
            });
        });
    });
</script>
@endsection

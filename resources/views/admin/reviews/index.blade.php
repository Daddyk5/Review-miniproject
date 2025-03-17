@extends('layouts.admin')

@section('content')
<div class="container py-8">
    <h2 class="text-3xl font-bold mb-6 text-white">⭐ Reviews Management</h2>

    @if($reviews->count())
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-gray-800 text-white rounded-lg overflow-hidden">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">👤 User</th>
                        <th class="px-4 py-3 text-left">🎬 Movie</th>
                        <th class="px-4 py-3 text-left">⭐ Rating</th>
                        <th class="px-4 py-3 text-left">📝 Content</th>
                        <th class="px-4 py-3 text-center">⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition duration-150">
                            {{-- User --}}
                            <td class="px-4 py-3">{{ $review->user->name }}</td>
                            
                            {{-- Movie --}}
                            <td class="px-4 py-3">{{ $review->movie->title }}</td>
                            
                            {{-- Star Rating --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-yellow-400' : 'bi-star text-gray-500' }}"></i>
                                    @endfor
                                    <span>({{ $review->rating }}/5)</span>
                                </div>
                            </td>

                            {{-- Content --}}
                            <td class="px-4 py-3">{{ Str::limit($review->content, 50, '...') }}</td>

                            {{-- Actions --}}
                            <td class="px-4 py-3 text-center space-x-2">
                                {{-- View Button --}}
                                <a href="{{ route('admin.reviews.show', $review->id) }}" 
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    View
                                </a>

                                {{-- Delete Form --}}
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    @else
        <p class="text-gray-400">No reviews found.</p>
    @endif
</div>
@endsection

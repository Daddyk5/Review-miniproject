@extends('layouts.admin')

@section('content')
<div class="container py-8">
    <h2 class="text-3xl font-bold mb-6">💬 Comments Management</h2>

    @if($comments->count())
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">On Review (Movie)</th>
                    <th class="px-4 py-2">Content</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $comment->user->name }}</td>
                        <td class="px-4 py-2">
                            <strong>{{ $comment->review->movie->title }}</strong><br>
                            {{ Str::limit($comment->review->content, 30) }}
                        </td>
                        <td class="px-4 py-2">{{ Str::limit($comment->content, 50) }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $comments->links() }}</div>
    @else
        <p>No comments found.</p>
    @endif
</div>
@endsection

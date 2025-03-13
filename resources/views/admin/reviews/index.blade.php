<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Movie</th>
            <th>User</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
        <tr>
            <td>{{ $review->id }}</td>
            <td>{{ $review->movie->title }}</td>
            <td>{{ $review->user->name }}</td>
            <td>{{ $review->rating }}/5</td>
            <td>{{ Str::limit($review->comment, 50) }}</td>
            <td>
                <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No reviews found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination Links --}}
<div class="mt-4">
    {{ $reviews->links() }}
</div>

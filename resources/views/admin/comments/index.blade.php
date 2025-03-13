@extends('layouts.admin')

@section('content')
<h1>Comments Management</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead><tr><th>User</th><th>Review</th><th>Actions</th></tr></thead>
    <tbody>
    @foreach($comments as $comment)
        <tr>
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->review->content }}</td>
            <td>
                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $comments->links() }}
@endsection

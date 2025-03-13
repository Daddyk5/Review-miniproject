@extends('layouts.admin')

@section('content')
<h2 class="mb-4">🎥 Manage Movies</h2>

<a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">+ Add New Movie</a>

<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre->name ?? 'N/A' }}</td>
                <td>
                    <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Delete this movie?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

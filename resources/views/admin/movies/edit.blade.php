@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-white">🎬 Edit Movie</h1>

<form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @method('PUT')
    @include('admin.movies.form')
    <button type="submit" class="bg-yellow-500 text-black px-6 py-2 rounded hover:bg-yellow-600">Update Movie</button>
    <a href="{{ route('admin.movies.index') }}" class="text-gray-400 hover:underline">Cancel</a>
</form>
@endsection

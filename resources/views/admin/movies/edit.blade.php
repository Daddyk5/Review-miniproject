@extends('layouts.admin')

@section('content')
<h1>Edit Movie</h1>

<form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.movies.form')
</form>

<a href="{{ route('admin.movies.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection

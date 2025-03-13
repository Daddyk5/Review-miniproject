@extends('layouts.admin')

@section('content')
<h1>Add New Movie</h1>

<form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.movies.form')
</form>

<a href="{{ route('admin.movies.index') }}" class="btn btn-secondary mt-3">Back to Movies</a>
@endsection

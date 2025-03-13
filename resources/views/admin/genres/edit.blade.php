@extends('layouts.admin')

@section('content')
<h1>Edit Genre</h1>

<form action="{{ route('admin.genres.update', $genre) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.genres.form', ['genre' => $genre])
</form>
@endsection

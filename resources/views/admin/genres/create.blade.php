@extends('layouts.admin')

@section('content')
<h1>Add Genre</h1>

<form action="{{ route('admin.genres.store') }}" method="POST">
    @include('admin.genres.form')
</form>
@endsection

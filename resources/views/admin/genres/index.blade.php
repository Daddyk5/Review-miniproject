@extends('layouts.admin')

@section('content')
<h2 class="mb-4">🎬 Manage Genres</h2>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Add New Genre Form --}}
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">
        <h5 class="card-title">+ Add New Genre</h5>
        <form method="POST" action="{{ route('admin.genres.store') }}" class="row g-3">
            @csrf
            <div class="col-md-9">
                <input type="text" name="name" placeholder="Enter Genre Name" class="form-control" required>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-warning">Add Genre</button>
            </div>
        </form>
    </div>
</div>

{{-- List of Genres --}}
<div class="table-responsive">
    <table class="table table-dark table-hover align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Genre Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No genres found. Add some!</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">{{ $genres->links() }}</div>
@endsection

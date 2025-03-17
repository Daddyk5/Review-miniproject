@extends('layouts.admin')

@section('content')
<div class="container py-8">

    {{-- ✅ Page Title --}}
    <h2 class="text-3xl font-bold mb-6 text-white">🎬 Manage Movies</h2>

    {{-- ✅ Add New Movie Button --}}
    <a href="{{ route('admin.movies.create') }}" 
       class="bg-yellow-500 text-black px-4 py-2 rounded mb-6 inline-block hover:bg-yellow-600 font-semibold">
        + Add New Movie
    </a>

    {{-- ✅ Movies Table --}}
    @if ($movies->count())
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full bg-gray-800 text-white rounded-lg">
                <thead class="bg-gray-900 text-center">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Genres</th>
                        <th class="px-4 py-3">Poster</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition duration-150">
                            {{-- ID --}}
                            <td class="px-4 py-3 text-center">{{ $movie->id }}</td>

                            {{-- Title --}}
                            <td class="px-4 py-3">{{ $movie->title }}</td>

                            {{-- Genres --}}
                            <td class="px-4 py-3">
                                {{ $movie->genres->pluck('name')->join(', ') }}
                            </td>

                            {{-- Poster --}}
                            <td class="px-4 py-3 text-center">
                                @if ($movie->poster)
                                    <img src="{{ asset('storage/' . $movie->poster) }}" 
                                         alt="Poster"
                                         class="w-20 h-28 object-cover rounded shadow-md border border-gray-600 mx-auto">
                                @else
                                    <span class="text-gray-400 italic">No Image</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3 text-center space-x-2">
                                {{-- Edit --}}
                                <a href="{{ route('admin.movies.edit', $movie) }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $movies->links() }}
        </div>
    @else
        {{-- No Movies --}}
        <p class="text-gray-400 mt-6 italic">No movies added yet.</p>
    @endif

</div>
@endsection

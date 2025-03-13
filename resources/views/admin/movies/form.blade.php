@csrf

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $movie->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="poster" class="form-label">Poster Image</label>
    <input type="file" name="poster" id="poster" class="form-control">
    @if (!empty($movie->poster))
        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" class="mt-2" style="max-width: 150px;">
    @endif
</div>

<div class="mb-3">
    <label for="genres" class="form-label">Genres</label>
    <select name="genres[]" id="genres" class="form-control" multiple>
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}"
                {{ (isset($movie) && $movie->genres->contains($genre->id)) ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">Save</button>

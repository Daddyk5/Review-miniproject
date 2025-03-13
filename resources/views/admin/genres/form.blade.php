@csrf

<div class="mb-3">
    <label for="name" class="form-label">Genre Name</label>
    <input type="text" name="name" id="name" class="form-control"
           value="{{ old('name', $genre->name ?? '') }}"
           placeholder="Enter Genre Name" required>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($genre) ? 'Update Genre' : 'Add Genre' }}
</button>

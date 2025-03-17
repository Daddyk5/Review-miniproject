@props(['rating' => 0, 'editable' => false, 'name' => 'rating'])

<div class="flex space-x-1">
    @for ($i = 1; $i <= 5; $i++)
        @if ($editable)
            <label>
                <input type="radio" name="{{ $name }}" value="{{ $i }}" class="hidden" {{ $rating == $i ? 'checked' : '' }}>
                <svg class="w-6 h-6 cursor-pointer {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455 1.287 3.966c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.377 2.396c-.785.57-1.84-.197-1.54-1.118l1.287-3.966-3.38-2.455c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                </svg>
            </label>
        @else
            <svg class="w-6 h-6 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455 1.287 3.966c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.377 2.396c-.785.57-1.84-.197-1.54-1.118l1.287-3.966-3.38-2.455c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
            </svg>
        @endif
    @endfor
</div>

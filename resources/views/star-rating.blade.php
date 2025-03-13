@props(['rating'])

@php
    $rating = (int) $rating;
@endphp

<div class="text-warning">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $rating)
            <i class="bi bi-star-fill"></i> {{-- Full star --}}
        @else
            <i class="bi bi-star"></i> {{-- Empty star --}}
        @endif
    @endfor
</div>

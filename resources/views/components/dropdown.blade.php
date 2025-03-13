@props([
    'align' => 'right', 
    'width' => '48', 
    'contentClasses' => 'py-1 bg-white dark:bg-gray-700 shadow-lg'
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'origin-top-left left-0',
        'top' => 'origin-top',
        default => 'origin-top-right right-0',
    };

    $widthClass = match ($width) {
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
        default => $width,
    };
@endphp

<div class="relative inline-block text-left" x-data="{ open: false }" @click.outside="open = false">
    
    {{-- Dropdown Trigger --}}
    <div @click="open = ! open" class="cursor-pointer select-none">
        {{ $trigger }}
    </div>

    {{-- Dropdown Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClass }} {{ $alignmentClasses }}"
        style="display: none;"
    >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $slot }}
        </div>
    </div>
</div>

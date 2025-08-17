@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-black/90 backdrop-blur-md border border-red-500/20'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <div @click="open = ! open" class="cursor-pointer select-none">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-[99999] mt-2 {{ $width }} rounded-lg shadow-xl {{ $alignmentClasses }}"
            style="display: none;">
        <div class="rounded-lg ring-1 ring-red-500/30 shadow-2xl {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

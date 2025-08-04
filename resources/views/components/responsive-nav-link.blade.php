@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-red-400 text-start text-base font-medium text-white bg-red-500/20 focus:outline-none focus:text-white focus:bg-red-500/30 focus:border-red-500 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-red-300 hover:bg-red-500/10 hover:border-red-300 focus:outline-none focus:text-red-300 focus:bg-red-500/10 focus:border-red-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

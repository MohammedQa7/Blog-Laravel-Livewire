@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center  hover:text-yellow-900 text-sm text-yellow-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center  hover:text-yellow-900 text-sm text-grey-500 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

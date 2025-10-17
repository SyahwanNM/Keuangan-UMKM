@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 style="color: var(--color-text, #1F2937);" focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 style="color: var(--color-text_secondary, #6B7280);" hover:style="color: var(--color-text_secondary, #6B7280);" hover:border-gray-300 focus:outline-none focus:style="color: var(--color-text_secondary, #6B7280);" focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center py-6 px-10 text-lg font-bold leading-5 text-[#72559D] focus:outline-none focus:border-indigo-700 transition bg-[#F6F8FC] border-r-[5px] border-[#72559D]'
            : 'inline-flex items-center py-6 px-10 text-lg font-bold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

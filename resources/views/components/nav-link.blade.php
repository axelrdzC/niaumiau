@props(['active'])

@php
$classes = ($active ?? false)
            ? ' bg-gradient-to-b from-[#ffff] to-[#E4E4E4]
                inline-flex items-center px-3 bg-white rounded-md border-2 border-indigo-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out
                hover:bg-gray-50
                hover:scale-105 transform transition-all duration-200 '
            : ' 
                hover:bg-gray-50
                hover:scale-105 transform transition-all duration-200
                focus:scale-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  
                inline-flex items-center px-3 rounded-md border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

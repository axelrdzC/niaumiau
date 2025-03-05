<a {{ $attributes->merge(['type' => 'button', 'class' => 
    'border shadow-md rounded px-4 py-1 items-center
    rounded-md 
    hover:scale-105 transform transition-all duration-200 
    focus:scale-100 focus:outline-none focus:ring-2 focus:ring-offset-2
    disabled:opacity-25 transition ease-in-out duration-150']) }}>
{{ $slot }}
</a>

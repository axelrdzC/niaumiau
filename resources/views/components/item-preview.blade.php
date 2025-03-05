<button {{ $attributes->merge(['type' => 'button', 'class' => 
    'p-4 
    bg-white rounded-md shadow-md 
    hover:cursor-pointer hover:scale-105 transform transition-all duration-200
    focus:outline-none']) }}>
    {{ $slot }}
</button>

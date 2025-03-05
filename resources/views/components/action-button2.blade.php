<button {{ $attributes->merge(['type' => 'button', 'class' => 
    'inline-flex items-center gap-3 px-4 py-2 
    bg-[#EC798C] dark:bg-gray-800 
    border border-gray-300 dark:border-gray-500 rounded-md 
    text-base text-gray-700 dark:text-gray-300 tracking-widest text-white
    shadow-sm 
    hover:scale-105 transform transition-all duration-200 
    focus:scale-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 
    disabled:opacity-25 transition ease-in-out duration-150']) }}>
{{ $slot }}
</button>
<select {{ $attributes->merge(['class' => 
    'w-40 border-gray-300 py-1 rounded-md shadow-sm
    focus:ring-indigo-500 focus:border-indigo-500']) }} name="{{ $name }}" id="{{ $id }}">
    {{ $slot }}
</select>

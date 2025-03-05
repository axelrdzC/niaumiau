@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => '
    bg-transparent p-0 border-0 border-b
    flex-1
    focus:ring-indigo-500 dark:focus:ring-indigo-600']) }}>

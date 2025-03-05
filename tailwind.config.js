import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                kosugi: ['Kosugi', 'serif'],
                michroma: ['Michroma', 'serif'],
                micro5: ['"Micro 5"', 'serif'],
                pixelify: ['"Pixelify Sans"', 'serif'],
            },
            backgroundImage: {
                'backapple': "url('/img/backapple.jpg')",
            },
        },
    },

    plugins: [forms],
};

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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: 'hsl(220, 70%, 25%)', // Navy Blue
                    light: 'hsl(220, 60%, 35%)',
                    dark: 'hsl(220, 70%, 20%)',
                },
                accent: {
                    DEFAULT: 'hsl(75, 45%, 40%)', // Olive Green
                    light: 'hsl(80, 50%, 45%)',
                    dark: 'hsl(75, 45%, 35%)',
                },
                background: 'hsl(0, 0%, 98%)', // Off-white
                foreground: 'hsl(215, 25%, 27%)', // Charcoal gray
            },
        },
    },

    plugins: [forms],
};

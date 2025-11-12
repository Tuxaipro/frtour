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
                    DEFAULT: 'hsl(201, 96%, 32%)', // Ocean Blue - inspired by tropical waters
                    light: 'hsl(201, 96%, 42%)',
                    dark: 'hsl(201, 96%, 22%)',
                    50: 'hsl(201, 96%, 95%)',
                    100: 'hsl(201, 96%, 90%)',
                    200: 'hsl(201, 96%, 80%)',
                    300: 'hsl(201, 96%, 70%)',
                    400: 'hsl(201, 96%, 50%)',
                    500: 'hsl(201, 96%, 32%)',
                    600: 'hsl(201, 96%, 22%)',
                    700: 'hsl(201, 96%, 18%)',
                    800: 'hsl(201, 96%, 15%)',
                    900: 'hsl(201, 96%, 12%)',
                },
                accent: {
                    DEFAULT: 'hsl(142, 71%, 45%)', // Forest Green - nature inspired
                    light: 'hsl(142, 71%, 55%)',
                    dark: 'hsl(142, 71%, 35%)',
                    50: 'hsl(142, 71%, 95%)',
                    100: 'hsl(142, 71%, 90%)',
                    200: 'hsl(142, 71%, 80%)',
                    300: 'hsl(142, 71%, 70%)',
                    400: 'hsl(142, 71%, 55%)',
                    500: 'hsl(142, 71%, 45%)',
                    600: 'hsl(142, 71%, 35%)',
                    700: 'hsl(142, 71%, 28%)',
                    800: 'hsl(142, 71%, 22%)',
                    900: 'hsl(142, 71%, 18%)',
                },
                sunset: {
                    DEFAULT: 'hsl(25, 95%, 53%)', // Sunset Orange
                    light: 'hsl(25, 95%, 63%)',
                    dark: 'hsl(25, 95%, 43%)',
                },
                sand: {
                    DEFAULT: 'hsl(45, 55%, 85%)', // Beach Sand
                    light: 'hsl(45, 55%, 95%)',
                    dark: 'hsl(45, 55%, 75%)',
                },
                background: 'hsl(0, 0%, 99%)', // Pure white with slight warmth
                foreground: 'hsl(215, 25%, 27%)', // Charcoal gray
            },
        },
    },

    plugins: [forms],
};

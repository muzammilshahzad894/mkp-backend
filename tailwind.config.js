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
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['Syne', '"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                login: ['Inter', 'system-ui', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'aurora-shift': 'aurora-shift 14s ease-in-out infinite',
                'float': 'float 6s ease-in-out infinite',
            },
            keyframes: {
                'aurora-shift': {
                    '0%, 100%': { transform: 'translate(0, 0) scale(1)' },
                    '33%': { transform: 'translate(8%, -4%) scale(1.05)' },
                    '66%': { transform: 'translate(-6%, 6%) scale(0.98)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
            },
        },
    },

    plugins: [forms],
};

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
                    50: '#f0f5fa',
                    100: '#e1ebf4',
                    200: '#c3d8e9',
                    300: '#94bddd',
                    400: '#5e9bcc',
                    500: '#3a7db4',
                    600: '#2a6396',
                    700: '#224f79',
                    800: '#1e4365',
                    900: '#1b3854',
                    950: '#112338',
                },
                accent: {
                    DEFAULT: '#f59e0b',
                    hover: '#d97706',
                }
            }
        },
    },

    plugins: [forms],
};

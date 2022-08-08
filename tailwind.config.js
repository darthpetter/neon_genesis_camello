const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                sans_serif: ['Poppins',...defaultTheme.fontFamily.sans],
                monospace:['Inconsolata',...defaultTheme.fontFamily.mono],
            },
            colors: {
                guayaquil: {
                  50: '#F0F6FB',
                  100: '#CDE0F2',
                  200: '#ADCCEA',
                  300: '#90BAE2',
                  400: '#75AADB',
                  500: '#5A9AD4',
                  600: '#428BCE',
                  700: '#327DC2',
                  800: '#2D70AF',
                  900: '#245481',
                },
                success: {
                  500: '#88BA14',
                },
                danger: {
                  500: '#FF5667',
                },
                info: {
                  500: '#43B3F9',
                },
                warning: {
                  500: '#FF9A3D',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};

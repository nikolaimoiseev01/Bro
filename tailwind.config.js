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
                sans: ['"Montserrat"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'black-main': '#131313',
                'black-light': '#202020',

                'grey-main': '#F6F6F6',
                'grey-light': '#a6a6a6',

                'blue': '#59B5E2',
                'pink': '#C4A9CA',
                'brown': '#342216'
            },
            spacing: {
                '128': '32rem',
                '156': '52rem',
            },
            translate: {
                '-1/2': '-50%',
            },
            zIndex: {
                '1': '1',
            },
            height: {
                '9_5': '38px',
            },
            letterSpacing: {
                tightest: '-.075em',
                tighter: '-.05em',
                tight: '-.025em',
                normal: '0',
                wide: '.025em',
                wider: '0.5em',
                widest: '1em'
            }
        },


    },

    plugins: [forms],
};

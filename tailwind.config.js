import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/tw-elements/dist/js/**/*.js"
      ],

    theme: {
        extend: {
            colors: {
                'main' : '#01998e',
              },
              width: {
                '428' : '428px',
              },
              height: {
                '8.5' : '34px'
              }
             },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

        },
    plugins: [
        forms,
        require('flowbite/plugin'),
        require("tw-elements/dist/plugin.cjs")
    ],
};

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './public/js/**/*.js',
    ],
    theme: {
        extend: {
            transitionProperty: {
                'left': 'left',
                'top': 'top'
            },
            maxHeight: {
                '100': 'calc(100vh - 8rem)',
            },
            minWidth: {
                '100': 'calc(100% - 260px)'
            },
            colors: {
                light: "hsl(11deg 100% 65%)",
                primary: "hsl(11deg 100% 55%)",
                dark: "hsl(11deg 100% 45%)",
            }
        },
    },
    plugins: [],
};
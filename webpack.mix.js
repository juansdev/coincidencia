const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue().sass('resources/sass/app.scss', 'public/css').options({
    postCss: [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nested'),
        require('autoprefixer'),
    ]
}).copyDirectory('resources/js/assets', 'public/assets');

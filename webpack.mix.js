const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/properties.js', 'public/js')
    .js('resources/js/tenants.js', 'public/js')
    .js('resources/js/tenancies.js', 'public/js')
    .js('resources/js/messages.js', 'public/js')
    .js('resources/js/zip-code.js', 'public/js')
    .js('resources/js/visits.js', 'public/js')
    .copy('resources/images', 'public/images')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');

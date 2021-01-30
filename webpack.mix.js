const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/appOrderWindow.js', 'public/js')
    .js('resources/js/appAdmin.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/authPages.scss', 'public/css')
    .sass('resources/sass/adminPages.scss', 'public/css')
    .sass('resources/sass/guestPages.scss', 'public/css')
    .sass('resources/sass/orderwindow.scss', 'public/css');

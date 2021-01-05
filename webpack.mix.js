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
   .sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/web/app.js', 'public/js/web')
   .js('resources/js/web/dashboard.js', 'public/js/web')
   .js('resources/js/web/requests.js', 'public/js/web')
   .sass('resources/sass/web/app.scss', 'public/css/web');

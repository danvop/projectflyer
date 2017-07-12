const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js(['resources/assets/js/libs/sweetalert-dev.js',
        'resources/assets/js/libs/lity.js'], 'public/js/libs.js')
   .styles(['resources/assets/css/libs/sweetalert.css',
            'resources/assets/css/libs/lity.css'], 'public/css/libs.css')
   ;


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
    .sass('resources/sass/pages/auth_pages.scss', 'public/css/pages')
    
    
    // dashboards
    .js('resources/js/dashboards/maps.js', 'public/js/dashboards')

    .js('resources/js/dashboards/admin/settings.js', 'public/js/dashboards/admin')
    .sass('resources/sass/dashboards/admin/settings.scss', 'public/css/dashboards/admin')
    .sass('resources/sass/dashboards/dashboards.scss', 'public/css/dashboards/')
    
    .options({processCssUrls: false});

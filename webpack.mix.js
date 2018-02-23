let mix = require('laravel-mix');

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

mix.autoload({
    jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
});

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
      'node_modules/sweetalert/dist/sweetalert.css',
      'resources/assets/sass/plugins/slick-theme.min.scss',
      'resources/assets/sass/plugins/slick.min.scss',
      'resources/assets/sass/plugins/swiper.min.scss',
    ], 'public/css/vendor.css')
    .scripts([
      'node_modules/jquery/dist/jquery.js',
      'node_modules/sweetalert/dist/sweetalert.min.js',
      'resources/assets/js/vendor/jquery.matchHeight-min.js',
      'resources/assets/js/vendor/scripts.js',
      'resources/assets/js/vendor/swiper.min.js',
      'resources/assets/js/vendor/slick.min.js',
    ], 'public/js/vendor.js')
    .scripts([
      'resources/assets/js/vendor/ckeditor/ckeditor.js',
      'resources/assets/js/vendor/ckeditor/adapters/jquery.js',
    ], 'public/js/editor.js')
    .sourceMaps()
    .options({
      processCssUrls: false
    }).copy('resources/assets/img', 'public/images');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
      'node_modules/sweetalert/dist/sweetalert.css',
      'resources/assets/sass/plugins/slick-theme.min.scss',
      'resources/assets/sass/plugins/slick.min.scss',
      'resources/assets/sass/plugins/swiper.min.scss',
      'resources/assets/sass/plugins/trumbowyg.min.scss',
    ], 'public/css/vendor.css')
    .scripts([
      'resources/assets/js/vendor/jquery.min.js',
      'resources/assets/js/vendor/jquery.cookielaw.js',
      'resources/assets/js/vendor/jquery.matchHeight-min.js',
      'resources/assets/js/vendor/lazyload.min.js',
      'resources/assets/js/vendor/swiper.min.js',
      'resources/assets/js/vendor/slick.min.js',
      'resources/assets/js/vendor/swal.js',
      'resources/assets/js/vendor/trumbowyg.min.js',
      'resources/assets/js/vendor/trumbowyg.upload.js',
      'resources/assets/js/vendor/trumbowyg.cleanpaste.min.js',
      // 'node_modules/sweetalert/dist/sweetalert.min.js',
      // 'resources/assets/js/vendor/scripts.js',
    ], 'public/js/vendor.js')
    .scripts([
      'resources/assets/js/vendor/ckeditor/ckeditor.js',
      'resources/assets/js/vendor/ckeditor/adapters/jquery.js',
    ], 'public/js/editor.js')
    .sourceMaps()
    .options({
      processCssUrls: false
    }).copy('resources/assets/img', 'public/images');

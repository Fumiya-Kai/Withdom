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
   .js('resources/js/addForm.js', 'public/js')
   .js('resources/js/comboBox.js', 'public/js')
   .js('resources/js/editor.js', 'public/js')
   .js('resources/js/article.js', 'public/js')
   .js('resources/js/common.js', 'public/js')
   .css('resources/css/app.css', 'public/css')
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps()
   .autoload({
     "jquery": ['$', 'window.jQuery'],
   })
   .extract(['jquery']);

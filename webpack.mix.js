const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
<<<<<<< HEAD
 | for your Laravel application. By default, we are compiling the Sass
=======
 | for your Laravel applications. By default, we are compiling the CSS
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
 | file for the application as well as bundling up all the JS files.
 |
 */

<<<<<<< HEAD
// mix
//   .js('resources/js/app.js', 'public/js')
//   .postCss('resources/css/app.css', 'public/css', [
//    //
//   ]);

// if (mix.inProduction()) {
//   mix
//     .version();
// }
=======
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

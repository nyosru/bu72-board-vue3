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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');



// mix.setPublicPath('../../public').mergeManifest();
// mix.setPublicPath( 'public/vitrin').mergeManifest();

// mix.styles(__dirname + '/Resources/assets/app.scss', '/app.css');

mix.js( 'resources/js/app.js', 'vitrin/app.js').vue();

// mix.js(__dirname + '/Resources/assets/js/app.js', 'js/vitrin.js').vue();
mix.copy( "resources/favicon.ico", "vitrin/favicon.ico");

//mix
    //.js(__dirname + '/Resources/assets/js/app.js', 'js/vitrin.js')
    //.sass( __dirname + '/Resources/assets/sass/app.scss', 'css/vitrin.css');

if (mix.inProduction()) {
    mix.version();
}

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
    jQuery: 'jquery',
    $: 'jquery',
    jquery: 'jquery',
    vue: ['Vue','window.Vue'],
    moment: ['moment','window.moment'],
});

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['vue'])
    .sass('resources/assets/sass/app.scss', 'public/css');

//mix.browserSync('http://127.0.0.1:8000');

mix.scripts([
    'public/js/perfect-scrollbar.jquery.js',
    'public/js/off-canvas.js',
    'public/js/misc.js',
    'public/js/dashboard.js'
],'public/js/scriptgeneral.js');

if (mix.inProduction()) {
    mix.version();
}
mix.disableNotifications();
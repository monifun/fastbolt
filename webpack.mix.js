const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .extract(['vue', 'alpinejs', 'axios', 'chart.js', 'date-fns', 'lodash'])
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .copy('resources/img', 'public/img')
    .copy('resources/svg', 'public/svg')
    .webpackConfig(require('./webpack.config'))
    .options({
        terser: {
            extractComments: false,
        },
    });

if (mix.inProduction()) {
    mix.version();
}

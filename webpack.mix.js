const mix = require("laravel-mix");

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

mix.sass(
    "resources/assets/frontend/scss/style.scss",
    "public/frontend/css/style.css"
).options({
    processCssUrls: false,
    autoprefixer: { remove: false }
});

mix.sass(
    "resources/assets/backend/scss/style.scss",
    "public/backend/css/style.css"
).options({
    processCssUrls: false,
    autoprefixer: { remove: false }
});

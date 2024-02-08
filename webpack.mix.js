const mix = require('laravel-mix');
mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.min.css'
], 'public/css/all.css');
mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
], 'public/js/all.js');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

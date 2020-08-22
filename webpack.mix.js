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

mix.sass('resources/views/scss/template.scss', 'public/css/template_bootstrap.css')
    .sass('resources/views/scss/fontawesome.scss', 'public/css/fontawesome.css')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'public/css/dataTables.bootstrap4.css')
    .copy('node_modules/startbootstrap-sb-admin-2/img/undraw_posting_photo.svg', 'public/img/undraw_posting_photo.svg')
    .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    .scripts('node_modules/jquery/jquery.easing.js', 'public/js/jquery.easing.js')
    .scripts('node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js', 'public/js/sb-admin-2.js')
    .scripts('node_modules/chart.js/dist/Chart.js', 'public/js/Chart.js')
    .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/chart-area-demo.js', 'public/js/chart-area-demo.js')
    .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js', 'public/js/chart-pie-demo.js')
    .scripts('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js/jquery.dataTables.js')
    .scripts('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/js/dataTables.bootstrap4.js');

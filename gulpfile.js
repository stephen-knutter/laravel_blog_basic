var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

  mix.sass('app.scss');

  mix.styles([
    'app.css',
    'main.css',
    'lib/bootstrap.min.css',
    'lib/select2.min.css'
  ], null, 'public/css');

  mix.version('public/css/all.css');

  mix.scripts([
    'lib/jquery.js',
    'lib/bootstrap.min.js',
    'lib/select2.min.js'
  ], null, 'public/js')

  /**
  * PHPUnit Example
  */
  //mix.phpUnit();

    /**
    * CSS Example
    */
    // mix.sass('app.scss');
    //
    // mix.styles([
    //   'main.css',
    //   'app.css'
    // ], 'public/output/final.css', 'public/css');

    /**
    * JS Example
    */
    // mix.scripts([
    //   'main.js',
    //   'coupon.js'
    // ], null, 'public/javascripts')
});

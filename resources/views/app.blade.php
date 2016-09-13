<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Document</title>
    <!-- select2.min.css, bootstrap.min.css  -->
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet" />
  </head>
  <body>

    <div class="container">
      @include('partials.flash')
      @yield('content')
    </div>

    <script src="/js/all.js"></script>
    <script type="text/javascript">
      $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

    @yield('footer')

  </body>

</html>

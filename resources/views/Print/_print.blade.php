<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Siimteq | @yield('title')</title>
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/font-open-sans/css/fonts.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" />
      @stack('head_style')
      @stack('page_script')
   </head>
   <body>
      <div class="container">
         @yield('page_header')
         @yield('page_title')
         @yield('page_body')
         @yield('page_footer')
      </div>
   </body>
</html>

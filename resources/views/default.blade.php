
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>WK Test</title>
      <!-- Scripts -->
      <script src="{{ mix('/js/app.js') }}" defer ></script>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
      <div id="app">
          <main class="py-3">
               <navbar></navbar>
               <div class="page-content p-5" id="content">
                  <router-view />
               </div>
          </main>
      </div>
  </body>
</html>

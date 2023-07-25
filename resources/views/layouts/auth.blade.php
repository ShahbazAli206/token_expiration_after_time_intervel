<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-image: url('../assets/img/curved-images/module0.png')">
    <div id="app">
        <nav class="menu" style="background-color: #43ced3">
            <img class="logo" src="{{asset('images/ali_logo.PNG')}}" alt="logo N/A">
            <ul>
                <a href="{{ url('/') }}">
              <li type="button" class="btn mt-3">
              <strong style="color: black; font-size: 18px; font-weight: bold;">Home</strong>
            </li>
        </a>
          </ul>
        </nav>

        <main class="py-4">


            @yield('content')
      
      
      
        </main>
    </div>
</body>
</html>
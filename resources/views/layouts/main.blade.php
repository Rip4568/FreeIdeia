<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  @vite(['resources/js/app.js'])
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <html data-theme="night"></html>
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.1/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  @yield('head')
</head>
<body>
  @include('layouts.navbar')
  <main id="root">
    @yield('content')
  </main>

  @include('layouts.footer')
  {{-- <script src="{{ asset('resources/js/app.js') }}"></script> --}}
  <script>
    
  </script>
</body>
</html>
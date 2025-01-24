<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AppVerk - zadanie rekrutacyjne FullStack Developer 2024</title>

    <link rel="stylesheet" href="{{ asset('/css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">

    @vite(['resources/js/app.js'])

  </head>
  <body class="body" id="app">
      {{ $slot }}
  </body>
</html>
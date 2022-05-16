<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jororiseba</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{asset('website/css/style.css')}}">

    </head>
    <body>
    @include('website.components.header')
    @yield('content')
    @include('website.components.footer')

    </body>
</html>
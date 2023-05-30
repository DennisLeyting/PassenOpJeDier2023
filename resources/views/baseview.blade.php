<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/css/style.css">
        @stack('css')
        @stack('js')
        <script src="/js/main.js"></script>
    
        <!-- google font
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
        google icons
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         -->
    
        <title>@yield('title')</title>
    </head>

    @yield('body')
    
    
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/nuiton_fonts.css')}}">


        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/minimal.css')}}">
       
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message">
                @yield('message')
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container py-5">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
        @yield('footer')
    </body>
</html>

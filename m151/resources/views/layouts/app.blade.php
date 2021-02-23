<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>M151</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/Planer.js') }}" defer></script>
    <script src="{{ asset('js/request.js') }}" defer></script>
    <script>
        var app_url = "{{ env('app_url') }}";
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}"  rel="stylesheet">

</head>
<body style="-webkit-print-color-adjust: exact;">
    <div id="app">
        @auth
            @include('layouts.inc.navbar')


            @include('layouts.inc.menu')


        @endauth
        @yield('floater')

        <div class="container-fluid mt-1">
            @yield('content')
        </div>
        @auth
            @include('layouts.inc.footer')
        @endauth

    </div>
    <script>
        var disabled = document.getElementsByClassName("disabled");
        for (var i = 0; i < disabled.length; i++) {
            disabled[i].onclick = function(e) {
                e.preventDefault();
            }
        }
    </script>
</body>
</html>

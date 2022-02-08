<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Главная')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('style', '')
    <style>
        .dropdown-login {
            padding: 0.25rem 1rem;
        }
        .nav-link-picture {
            padding: 0;
        }
    </style>
</head>
<body>
    <div id="app">
        <navbar-component></navbar-component>

        <main class="py-4">
            <div class="container">
                <router-view></router-view>
{{--                @yield('content')--}}
            </div>
        </main>
    </div>
</body>
</html>

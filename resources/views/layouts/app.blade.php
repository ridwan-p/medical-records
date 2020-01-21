<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __(config('app.name', 'Laravel')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}" defer></script>
    <script src="{{ asset('js/vendor.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('css')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                     <img src="{{ asset('images/logo.svg') }}" width="30" height="30" alt="logo-brand">
                    {{ __(config('app.name', 'Laravel')) }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item"><a href="{{ route('dashboard.index') }}" class="nav-link @if(Route::is('dashboard.index')) active @endif"><i class="material-icons">dashboard</i> {{ __('Dashboard') }}</a></li>
                            <li class="nav-item"><a href="{{ route('dashboard.patients.index') }}" class="nav-link @if(Route::is('dashboard.patients.*')) active @endif"><i class="material-icons">people</i> {{ __('Patient') }}</a></li>
                            <li class="nav-item"><a href="{{ route('dashboard.journals.index') }}" class="nav-link @if(Route::is('dashboard.journals.*')) active @endif"><i class="material-icons">list_alt</i> {{ __('Journal') }}</a></li>
                            <li class="nav-item"><a href="{{ route('dashboard.history.index') }}" class="nav-link @if(Route::is('dashboard.history.*')) active @endif"> <i class="material-icons">today</i> {{ __('History') }}</a></li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('dashboard.profile.index') }}" class="dropdown-item"><i class="material-icons">account_circle</i> {{__('Profile')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">power_settings_new</i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="mt-auto">
            <nav class="navbar navbar-light bg-light d-flex justify-content-center">
                <a href="{{ url('/') }}" class="text-dark">
                    <img src="{{ asset('images/logo.svg') }}" width="30" height="30" alt="logo-brand" />
                    {{ __(config('app.name', 'Laravel')) }} Copyright © {{now()->format('Y')}}
                </a>
            </nav>
        </footer>
    </div>

    @stack('js')

</body>
</html>

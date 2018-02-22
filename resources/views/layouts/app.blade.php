<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div id="app">

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="container d-flex flex-column flex-sm-row justify-content-center navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/forum">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/passmanager">Password Manager</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="user-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                            <a href="{{ route('logout') }}" class="dropdown-item text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#secondaryNav" aria-controls="secondaryNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> Navigation Options
            </button>
            <div class="collapse navbar-collapse justify-content-center bg-secondary" id="secondaryNav">
                <a class="nav-item nav-link text-light" href="/forum">Browse</a>
                <a class="nav-item nav-link text-light" href="/forum/threads/latest">Latest Threads</a>
                <a class="nav-item nav-link text-light" href="/forum/threads/activity">Latest Activity</a>
                <a class="nav-item nav-link text-light" href="/forum/threads/filter?popularity=popular">Popular Threads</a>
                @if (auth()->check())
                    <a class="nav-item nav-link text-light" href="/forum/threads/filter?by={{ auth()->user()->name }}">My Threads</a>
                    <a class="nav-item nav-link text-light" href="/forum/threads/create">New Thread</a>
                @endif
            </div>
        </nav>


        <div class="container-fluid mt-3">

            @yield('content')
            
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

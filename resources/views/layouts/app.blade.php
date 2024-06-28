<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-yellow shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('storage/images/lexicard_logo.png') }}" alt="" class="logo-md">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest

                        @else
                            <li class="nav-item dropdown d-flex">
                                <a href="{{ route('quiz.quiz.index') }}" class="nav-link px-5 border-end border-second text-second">
                                    Quiz
                                </a>

                                <a href="{{ route('category.otheruser.index') }}" class="nav-link px-5 border-end border-second text-second">
                                    Other User
                                </a>

                                <a href="{{ route('classroom.classroom.index') }}" class="nav-link px-5 border-end border-second text-second">
                                    Classrooms
                                </a>

                                <a id="navbarDropdown" class="nav-link dropdown-toggle px-5 text-second" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item">
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 bg-white">
            @yield('content')
        </main>

        @guest

        @else
            <footer class="bg-second py-5 mt5-">
                <nav class="navbar navbar-expand-md">
                    <div class="container">
                        <ul class="navbar-nav m-auto align-items-center">
                            <li class="nav-item dropdown d-flex  align-items-center">
                                <a href="{{ route('quiz.quiz.index') }}" class="nav-link px-5 border-end border-yellow text-yellow">
                                    Quiz
                                </a>

                                <a href="{{ route('category.otheruser.index') }}" class="nav-link px-5 text-yellow">
                                    Other User
                                </a>

                                <a class="navbar-brand" href="{{ route('home') }}">
                                    <img src="{{ asset('storage/images/lexicard_logo.png') }}" alt="" class="logo-md">
                                </a>

                                <a href="{{ route('classroom.classroom.index') }}" class="nav-link px-5 border-end border-yellow text-yellow">
                                    Classrooms
                                </a>

                                <a href="#" class="nav-link px-5 text-yellow">
                                    Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </footer>
        @endguest
    </div>
</body>
<style>
    body {
        font-family: "Noto Sans JP", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }
</style>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1fe3729de2.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header>
    <a href="{{ route('about') }}">
        <img src="{{ url('/images/logo.png') }}" alt="">
    </a>
    @guest
        <a href="{{ route('register')  }}">Login</a>
    @endguest
    @auth
        <a href="{{ route('profile.edit') }}">
            Hey, {{ Auth::user()->name }}!
        </a>
    @endauth
</header>

<main>
    {{ $slot }}
</main>

<footer>
    <nav>
        <a href="{{ route('quests.index') }}">
            <i class="fa-solid fa-scroll"></i>
        </a>

        <a href="{{ route('home') }}">
            <i class="fa-solid fa-house"></i>
        </a>

        <a href="{{ route('profile.edit') }}">
            <i class="fa-solid fa-user"></i>
        </a>
    </nav>
</footer>

</body>

</html>

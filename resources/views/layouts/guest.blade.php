<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/1fe3729de2.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[url('/public/images/bird.jpg')] bg-no-repeat bg-cover  overflow-hidden " >
        <div class="min-h-screen flex flex-col sm:justify-center items-center justify-center sm:pt-0  pb-36 ">
            <div>
                <a href="/">
                    <img src="{{URL::asset('images/logo.png')}}" alt="Natuurmonumenten logo" class="rounded-2xl w-28 h-28 ">
                </a>
            </div>

            <div class="rounded-xl sm:max-w-md m-6 px-14 py-8 bg-white dark:bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

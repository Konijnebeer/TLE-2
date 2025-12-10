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
        @auth
            @php
                // Admins can see all groups, regular users only see their groups
                $userGroups = Auth::user()->isAdmin()
                    ? \App\Models\Group::with('naturePark')->get()
                    : Auth::user()->groups()->with('naturePark')->get();
                $groupCount = $userGroups->count();
            @endphp

            @if($groupCount === 1 && !Auth::user()->isAdmin())
                @php
                    $naturePark = $userGroups->first()->naturePark;
                @endphp
                @if($naturePark)
                    <a href="{{ route('nature.quests', ['naturePark' => $naturePark->id]) }}">
                        <i class="fa-solid fa-scroll"></i>
                    </a>
                @else
                    <a href="#" onclick="alert('Geen natuurpark gevonden voor jouw klas'); return false;">
                        <i class="fa-solid fa-scroll"></i>
                    </a>
                @endif
            @elseif($groupCount > 1 || Auth::user()->isAdmin())
                <a href="#" x-data @click.prevent="$dispatch('open-modal', 'group-selection')">
                    <i class="fa-solid fa-scroll"></i>
                </a>
            @else
                <a href="#" onclick="alert('Je bent geen lid van een klas'); return false;">
                    <i class="fa-solid fa-scroll"></i>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}">
                <i class="fa-solid fa-scroll"></i>
            </a>
        @endauth

        <a href="{{ route('home') }}">
            <i class="fa-solid fa-house"></i>
        </a>

        <a href="{{ route('profile.edit') }}">
            <i class="fa-solid fa-user"></i>
        </a>
    </nav>
</footer>

@auth
    @if($userGroups->count() > 1 || Auth::user()->isAdmin())
        <x-modal name="group-selection" maxWidth="lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-center mb-4">
                    Selecteer een Klas
                </h2>

                <p class="text-center text-gray-600 mb-6">
                    Kies van welke klas je de quests wilt bekijken.
                </p>

                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($userGroups as $group)
                        @if($group->naturePark)
                            <a href="{{ route('nature.quests', ['naturePark' => $group->naturePark->id]) }}"
                               class="block w-full p-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <h3 class="font-bold text-lg">{{ $group->name }}</h3>
                                @if($group->description)
                                    <p class="text-gray-600 mt-1">{{ $group->description }}</p>
                                @endif
                            </a>
                        @endif
                    @empty
                        <p class="text-gray-600 mt-1">Geen klassen gvonden</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    <x-button
                        type="button"
                        :arrow="false"
                        x-on:click="$dispatch('close-modal', 'group-selection')"
                    >
                        Annuleren
                    </x-button>
                </div>
            </div>
        </x-modal>
    @endif
@endauth

</body>

</html>

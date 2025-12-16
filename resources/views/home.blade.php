<x-app-layout>
    <div class="py-3">
        <h1 class="text-center text-3xl">Welkom terug, {{ auth()->user()->name }}</h1>
    </div>

    <p class="text-center">
        @if(auth()->user()->groups->first())
            @if(auth()->user()->groups->first()->naturePark->state < 1)
                Jouw klas heeft nog geen punten verdiend!
            @elseif(auth()->user()->groups->first()->naturePark->state > 1)
                Jouw klas heeft al {{ auth()->user()->groups->first()->naturePark->state }} punten
                verdiend!
            @else
                Jouw klas heeft al {{ auth()->user()->groups->first()->naturePark->state }} punt
                verdiend!
            @endif
        @else
            Je zit nog niet in een klas!
            <a href="{{ route('profile.edit') }}">
                <x-button class="mt-3">
                    Voeg een klas toe
                </x-button>
            </a>
        @endif
    </p>

    <section class="flex flex-col gap-1 mt-5">
        <h2 class="text-center text-2xl">Ranglijst</h2>
        <div class="flex justify-between gap-3 text-left px-4 py-1 bg-gray-300 italic">
            <span class="text-center min-w-5">#</span>
            <span class="flex-1">Klas</span>
            <span>Punten</span>
        </div>
        @foreach($parks as $key => $park)
            <article
                class="flex justify-between gap-3 text-left px-4 py-1
                @if(auth()->user()->groups->first())
                    @if($park->getAttributes() === auth()->user()->groups->first()->naturePark->getAttributes()) border-2 border-solid border-amber-400 bg-amber-100 @elseif($key % 2 === 0) bg-gray-100 @else bg-gray-200 @endif"
                @endif
                tabindex="0"
                aria-label="Ranglijst positie {{ $key + 1 }}. {{ $park->group->name }} met {{ $park->state }} punten.">
                <span class="text-center min-w-5">{{ $key + 1 }}</span>
                <span class="flex-1">{{ $park->group->name }}</span>
                <span>{{ $park->state }}</span>
            </article>
            @php
                if(auth()->user()->groups->first()) {
                    if($park->getAttributes() === auth()->user()->groups->first()->naturePark->getAttributes()) {
                        $ownParkPosition = $key + 1;
                    }
                }
            @endphp
        @endforeach
    </section>

    <section class="mt-2">
        <h2 class="text-center text-2xl">Jouw positie</h2>
        @if(auth()->user()->groups->first())
            @php
                $ownPark = auth()->user()->groups->first()->naturePark;

                if($ownParkPosition > 1) {
                    $sortedParks = $parks->all();
                    $higherPark = $sortedParks[$ownParkPosition - 2]; // I have no idea why -2, but it works.

                    $pointsAway = $higherPark->state - $ownPark->state;
                }
            @endphp
            <article
                class="flex justify-between gap-3 text-left px-4 py-1 border-2 border-solid border-amber-400 bg-amber-100"
                tabindex="0"
                aria-label="Jouw Ranglijst positie {{ $ownParkPosition }}. {{ $ownPark->group->name }} met {{ $ownPark->state }} punten.">
                <span class="text-center min-w-5">{{ $ownParkPosition }}</span>
                <span class="flex-1">{{ $ownPark->group->name }}</span>
                <span>{{ $ownPark->state }}</span>
            </article>
            @if(!empty($pointsAway))
                <p class="text-center italic text-sm">Je bent {{ $pointsAway }}
                    @if($pointsAway === 0 || $pointsAway > 1)
                        punten
                    @else
                        punt
                    @endif verwijderd
                    van een hogere
                    positie!</p>
            @else
                <p class="text-center italic text-sm">
                    Je staat op nummer 1! Blijf zo doorgaan!
            @endif
        @endif
    </section>

    @if(auth()->user()->groups->first())
        <section class="mt-5">
            <h2 class="text-center text-2xl">Jouw natuurgebied</h2>
            <img src="{{ asset('natuurgebied-progression/' . $natureImages[$ownPark->state]) }}"
                 alt="Natuurgebied met voortgang {{ $ownPark->state }}">

            @if(auth()->user()->onboarding_completed === false && !auth()->user()->isAdmin() && auth()->user()->isActive())
                <div class="popup">
                    <x-infobox heading="Welkom!">
                        Hey avonturier! Ben jij klaar voor
                        een nieuw avontuur? Ja? Mooi! Klik
                        op de knop hieronder om gelijk te
                        beginnen!
                        @php
                            $firstUserGroup = Auth::user()->groups()->with('naturePark')->first();
                            $firstNaturePark = $firstUserGroup?->naturePark;
                            // Check if user is a guest in this group
                            $isGuest = $firstUserGroup && $firstUserGroup->pivot->role === \App\Enums\GroupRole::GUEST;
                        @endphp
                        @if($firstNaturePark && !$isGuest)
                            <a href="{{ route('nature.quests', ['naturePark' => $firstNaturePark->id]) }}"
                               style="z-index: 10;">
                                <x-button>
                                    Begin
                                </x-button>
                            </a>
                        @elseif($isGuest)
                            <p class="text-red-500 mt-2">Als gast heb je geen toegang tot quests. Neem contact op met je
                                leraar.</p>
                        @else
                            <a href="{{ route('profile.edit') }}" style="z-index: 10;">
                                <x-button>
                                    Voeg een klas toe
                                </x-button>
                            </a>
                        @endif
                    </x-infobox>
                </div>
            @endif
        </section>
    @endif
</x-app-layout>

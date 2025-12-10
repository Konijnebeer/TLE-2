<x-app-layout>
    <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-container">
            <div class="carousel-indicators">
                @foreach ($images as $index => $image)
                    <button type="button"
                            data-bs-target="#photoCarousel"
                            data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"
                            aria-current="{{ $index == 0 ? 'true' : '' }}"
                            aria-label="Slide {{ $index+1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('natuurgebied-progression/' . $image) }}" class="d-block w-100"
                             alt="Foto {{ $index+1 }}">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>

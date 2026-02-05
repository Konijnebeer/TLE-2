<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('quests.index') }}">
            <x-button variant="transparent" size="small" :arrow="false">
                ← Terug naar questen overzicht
            </x-button>
        </a>
    </div>
    <div class="p-4 space-y-10 pb-24">

        <h1>{{ $quest->name }}</h1>

        <x-infobox heading="Waarom?">
            {{ $quest->description }}
        </x-infobox>

<div class="border-2 border-solid border-black p-2 bg-white shadow-xl">
            @if($quest->difficulty_level === 1)

            <p>Moeilijkheidsgraad: Makkelijk</p>
        @elseif($quest->difficulty_level === 2)
            <p>Moeilijkheidsgraad: Gemiddeld</p>
        @elseif($quest->difficulty_level === 3)
            <p>Moeilijkheidsgraad: Moeilijk</p>
            @endif

        <p>Categorie: {{$quest->category}}</p>
    </div>



    </div>
</x-app-layout>

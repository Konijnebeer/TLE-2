<x-app-layout>

    <section
        id="mainSection"
        class="bg-[url('/public/images/hooglander.png')] pb-5 bg-no-repeat bg-cover bg-center overflow-hidden min-h-[calc(100vh-175px)]"
    >
        <h1 class="text-black m-4 text-center">Quests</h1>

        @forelse($quests as $questData)
            @php
                if($questData['completed'] < 1) {
                    $partLink = route('nature.quests.show', ['naturePark' => $naturePark->id, 'quest' => $questData['quest']->id]);
                } else {
                    $partLink = route('nature.quests.parts', ['naturePark' => $naturePark->id, 'quest' => $questData['quest']->id, 'part' => $questData['first_pending_part']->id]);
                }
            @endphp

            <x-questbox
                title="{{ $questData['quest']->name }}"
                progress="{{ $questData['completed'] }}/{{ $questData['total'] }}"
                questLink="{{ route('nature.quests.show', ['naturePark' => $naturePark->id, 'quest' => $questData['quest']->id]) }}"
                partLink="{{ $partLink }}"
            >
                {{--                {{ $questData['quest']->description }}--}}
            </x-questbox>
        @empty
            <p class="text-center text-white">Geen actieve quests op dit moment.</p>
        @endforelse

        <p class="text-center text-white">Kom snel terug voor meer quests!</p>

    </section>

</x-app-layout>

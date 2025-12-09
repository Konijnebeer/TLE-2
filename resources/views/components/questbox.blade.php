@props([
    'title' => 'Default title',
    'progress' => '?/?',
    'questLink' => '#',
    'partLink' => '#'
])

<div
    class=" border-2 border-solid shadow-lg border-black rounded-2 flex-row bg-white m-4 p-4 justify-between cursor-pointer hover:shadow-xl transition-shadow"
    onclick="window.location='{{ $questLink }}'">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-3xl">{{ $title }}</h2>
        <p class="text-md font-semibold">{{ $progress }}</p>
        {{--        <p class="">{{ $slot }}</p>--}}
    </div>


    <x-button
        onclick="event.stopPropagation(); window.location='{{ $partLink }}'"

    >
        Ga naar quest
    </x-button>


</div>

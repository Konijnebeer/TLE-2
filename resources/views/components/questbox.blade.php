@props([
    'title' => 'Default title',
    'progress' => '?/?',
    'link' => 1
])

<a href="{{ route('quests.show', $link) }}" id="button">
    <div
        class="flex border-2 border-solid shadow-lg border-black rounded-2 flex-row bg-white m-4 p-4 justify-between">

        <div class="items-start">
            <h2>{{ $title }}</h2>
            <p>{{ $slot }}</p>
        </div>
        <div class="flex  items-center ">
            <p>{{ $progress }}</p>
        </div>

    </div>
</a>

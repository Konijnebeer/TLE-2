<x-app-layout>
    @php
        // Simple view: always show open text input for parts (we removed multiple-choice support)
        $nextRoute = route('nature.quests.parts.next', [$naturePark, $quest, $part]);
    @endphp

    <h1 class="text-center">
        {{ $quest->name }}
    </h1>

    <x-infobox heading="{{ $part->name }}">
        {{ $part->description }}
    </x-infobox>

    <div class="mt-4">
        <x-input-label for="input_answer" value="Jouw antwoord" />
        <textarea id="input_answer" name="answer" class="w-full h-48 p-4 border border-gray-300 rounded-lg shadow-md" placeholder="Voer je antwoord hier in..."></textarea>
    </div>
    <div class="my-5 flex justify-center">
        <button id="input-check" class="bg-indigo-600 text-white px-4 py-2 rounded">Check</button>
    </div>

    <script>
        document.getElementById('input-check').addEventListener('click', function () {
            // No server-side validation here for open input; proceed to next part
            window.location = "{{ $nextRoute }}";
        });
    </script>
</x-app-layout>


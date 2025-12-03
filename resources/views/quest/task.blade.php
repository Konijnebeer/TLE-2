<x-app-layout>
    <h1>
        {{ $part->name }}
{{--        Wat moet je doen?--}}
    </h1>

    <x-infobox heading="DOEL?">{{ $part->description }}</x-infobox>

    @if($part->success_condition === 'textField')
        <textarea class="w-full h-48 p-4 border border-gray-300 rounded-lg shadow-md" placeholder="Voer je antwoord hier in..."></textarea>
    @else
        <div class="aspect-video bg-gray-300 rounded-lg shadow-md flex items-center justify-center p-4 mb-6">
            <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
            </svg>
        </div>
    @endif

    <x-button>
        Bekijk Quest
    </x-button>

</x-app-layout>


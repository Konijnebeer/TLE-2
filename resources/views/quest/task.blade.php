<x-app-layout>
    @php
        $partCondition = explode(':', $part->success_condition);
    @endphp
    @if ($partCondition[0] === 'timer')
        @vite('resources/js/task.js')
    @endif

    <h1 class="text-center">
        {{ $quest->name }}
    </h1>

    <x-infobox heading="{{ $part->name }}">
        {{ $part->description }}
    </x-infobox>

    @if($part->success_condition === 'textField')
        <textarea class="w-full h-48 p-4 border border-gray-300 rounded-lg shadow-md"
                  placeholder="Voer je antwoord hier in..."></textarea>
    @elseif($part->success_condition === 'timer:60s')
        <div class="aspect-video bg-gray-300 rounded-lg shadow-md flex items-center justify-center p-4 mb-6">
            <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                      clip-rule="evenodd"></path>
            </svg>
        </div>
    @endif

    @php
        $urlPart = (int) request()->segment(count(request()->segments()));

        $nextPart = $urlPart += 1;

        if($part->success_condition !== 'button') {
            $btnURL = '/quests/1/parts/' . $nextPart;
        } else {
            $btnURL = route('home');
            auth()->user()->update(['onboarding_completed' => true]);
        }
    @endphp

    <div class="my-5 flex justify-center">
        <a href="{{ url($btnURL) }}" @if(!empty($partCondition[1])) data-condition="{{$partCondition[1]}}" @endif >
            <x-button>
                @if($partCondition[0] === 'timer')
                    Volgende ({{ $partCondition[1] }})
                @elseif($partCondition[0] === 'textField')
                    Check
                @else
                    KLAAR!
                @endif
            </x-button>
        </a>
    </div>

</x-app-layout>


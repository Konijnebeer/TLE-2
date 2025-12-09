<x-app-layout>
    @php
        $partCondition = explode(':', $part->success_condition);

        if($partCondition[0] === 'multiple') {
            $multipleOptions = explode(',', $partCondition[1]);
        }
    @endphp
    @if ($partCondition[0] === 'timer')
        @vite('resources/js/task_timer.js')
    @elseif($partCondition[0] === 'input')
        @vite('resources/js/task_input.js')
    @endif

    <h1 class="text-center">
        {{ $quest->name }}
    </h1>

    <x-infobox heading="{{ $part->name }}">
        {{ $part->description }}
    </x-infobox>

    @if($partCondition[0] === 'input')
        <textarea id="input" class="w-full h-48 p-4 border border-gray-300 rounded-lg shadow-md"
                  placeholder="Voer je antwoord hier in..."></textarea>
    @endif

    @php
        $urlPart = (int) request()->segment(count(request()->segments()));
        $questID = $quest->id;

        $nextPart = $urlPart += 1;

        if($part->success_condition !== 'done') {
            $btnURL = "/quests/{$questID}/parts/" . $nextPart;
        } else {
            $btnURL = route('home');
            auth()->user()->update(['onboarding_completed' => true]);
        }
    @endphp

    @if($partCondition[0] === 'multiple')
        @foreach($multipleOptions as $key=>$option)
            <x-button variant="secondary" size="small" :arrow="false">
                {{ $option }}
            </x-button>
        @endforeach
    @endif

    <div class="my-5 flex justify-center">
        @if($partCondition[0] !== 'multiple')
            <a href="{{ url($btnURL) }}" @if(!empty($partCondition[1])) data-condition="{{$partCondition[1]}}" @endif >
                <x-button>
                    @if($partCondition[0] === 'timer')
                        Volgende ({{ $partCondition[1] }})
                    @elseif($partCondition[0] === 'input')
                        Check
                    @else
                        KLAAR!
                    @endif
                </x-button>
            </a>
        @endif
    </div>

</x-app-layout>


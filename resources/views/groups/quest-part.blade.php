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

    @if($partCondition[0] === 'multiple')
        <script>
            function checkAnswer(submittedAns) {
                const correctAnswer = {{ $partCondition[2] }};
                const nextRoute = "{{ route('nature.quests.parts.next', [$naturePark, $quest, $part]) }}";

                if (submittedAns == correctAnswer) {
                    window.location = nextRoute;
                } else {
                    alert('Dat antwoord is helaas fout! Probeer het opnieuw.');
                }
            }
        </script>
        <h3 class="text-center mb-2">Kies een antwoord:</h3>
        <div class="grid grid-cols-2 grid-rows-2 gap-2 p-2">
            @foreach($multipleOptions as $key=>$option)
                <x-button variant="answer" size="small" :arrow="false" onclick="checkAnswer({{ $key }})"
                          class="shadow">
                    {{$key+1}}. {{ $option }}
                </x-button>
            @endforeach
        </div>
    @endif

    <div class="my-5 flex justify-center">
        @if($partCondition[0] !== 'multiple')
            <a href="{{ route('nature.quests.parts.next', [$naturePark, $quest, $part]) }}"
               @if(!empty($partCondition[1])) data-condition="{{$partCondition[1]}}" @endif >
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


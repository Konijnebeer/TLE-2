{{--<x-app-layout>--}}
{{--    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between items-start mb-8">--}}
{{--            <div>--}}
{{--                <h1 class="text-3xl font-bold text-gray-900">Quest: {{ $quest->name }}</h1>--}}
{{--                <div class="mt-2 flex flex-wrap gap-2">--}}
{{--                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-bold uppercase rounded-full">--}}
{{--                        {{ $quest->category->name ?? $quest->category }}--}}
{{--                    </span>--}}
{{--                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-bold uppercase rounded-full">--}}
{{--                        Niveau {{ $quest->difficulty_level }}--}}
{{--                    </span>--}}
{{--                    <span class="px-3 py-1 {{ $quest->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-bold uppercase rounded-full">--}}
{{--                        {{ $quest->is_active ? 'Actief' : 'Inactief' }}--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a href="{{ route('admin.quests.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">--}}
{{--                <i class="fa-solid fa-arrow-left mr-2"></i> Terug naar overzicht--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="bg-white shadow rounded-lg p-6 mb-8">--}}
{{--            <h2 class="text-lg font-bold text-gray-900 mb-2 uppercase tracking-wider text-sm border-b pb-2">Beschrijving / Verhaal</h2>--}}
{{--            <p class="text-gray-700 whitespace-pre-line">{{ $quest->description }}</p>--}}
{{--        </div>--}}

{{--        <h2 class="text-xl font-semibold mb-4">Onderdelen (Steps)</h2>--}}

{{--        <div class="space-y-6">--}}
{{--            @foreach($quest->parts as $part)--}}
{{--                <div class="p-6 bg-white shadow rounded-lg border-l-4 border-indigo-500">--}}
{{--                    <div class="flex justify-between items-center mb-4">--}}
{{--                        <h3 class="font-bold text-lg text-indigo-900">Stap {{ $part->order_index }}: {{ $part->name }}</h3>--}}
{{--                        <a href="{{ route('admin.parts.answers', ['quest' => $quest->id, 'part' => $part->id]) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white rounded text-xs font-bold hover:bg-indigo-700 transition shadow-sm">--}}
{{--                            <i class="fa-solid fa-users mr-2"></i> Bekijk Antwoorden--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="grid gap-4">--}}
{{--                        <div>--}}
{{--                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Uitleg voor leerling</h4>--}}
{{--                            <p class="text-gray-700">{{ $part->description }}</p>--}}
{{--                        </div>--}}

{{--                        <div class="bg-blue-50 p-4 rounded border border-blue-100">--}}
{{--                            <h4 class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-1">Conditie / Correct Antwoord</h4>--}}
{{--                            <code class="text-blue-800 font-mono">{{ $part->success_condition }}</code>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    @if($part->answers->count())--}}
{{--                        <div class="mt-6 bg-gray-50 p-4 rounded border border-gray-200">--}}
{{--                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Ingeleverde antwoorden</h4>--}}
{{--                            <ul class="divide-y divide-gray-200">--}}
{{--                                @foreach($part->answers as $answer)--}}
{{--                                    <li class="py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">--}}
{{--                                        <div class="flex items-center gap-3">--}}
{{--                                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-xs">--}}
{{--                                                {{ substr($answer->user->name ?? '?', 0, 1) }}--}}
{{--                                            </div>--}}
{{--                                            <span class="font-semibold text-gray-800">{{ $answer->user->name ?? 'Onbekende gebruiker' }}</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-1 px-0 sm:px-4">--}}
{{--                                            <p class="text-gray-700 italic">"{{ $answer->answer_text }}"</p>--}}
{{--                                        </div>--}}
{{--                                        <span class="text-[10px] text-gray-400 whitespace-nowrap">{{ $answer->created_at ? $answer->created_at->format('d-m-Y H:i') : '' }}</span>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="mt-4 p-4 text-sm text-gray-500 italic bg-gray-50 rounded border border-dashed border-gray-200">--}}
{{--                            Nog geen antwoorden ingeleverd voor dit onderdeel.--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}


<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $quest->name }}</h1>
                <p class="text-sm text-gray-500 mt-1">Quest ID: #{{ $quest->id }} | Aangemaakt op: {{ $quest->created_at->format('d-m-Y') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.quests.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    ← Terug
                </a>
                <a href="{{ route('admin.quests.edit', $quest) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Bewerken
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 border-b pb-2">Configuratie</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-500 block">Categorie</label>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-bold rounded-full uppercase">
                                {{ $quest->category }}
                            </span>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 block">Moeilijkheid</label>
                            <span class="font-bold text-gray-800">Niveau {{ $quest->difficulty_level }}</span>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 block">Status</label>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full {{ $quest->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2 border-b pb-2">Verhaal / Introductie</h2>
                    <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">
                        {{ $quest->description }}
                    </p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fa-solid fa-list-check mr-2 text-indigo-500"></i>
                    Stappenoverzicht ({{ $quest->parts->count() }})
                </h2>

                @foreach($quest->parts->sortBy('order_index') as $part)
                    <div class="bg-white shadow rounded-lg overflow-hidden border-l-4 border-indigo-500">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="text-xs font-bold text-indigo-600 uppercase">Stap {{ $part->order_index }}</span>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $part->name }}</h3>
                                </div>
                                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded text-gray-500 uppercase font-bold">Tekst Vraag</span>
                            </div>

                            <div class="grid gap-4">
                                <div>
                                    <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Instructie voor leerling:</h4>
                                    <div class="text-sm text-gray-700 bg-gray-50 p-3 rounded border border-gray-100">
                                        {{ $part->description }}
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest mb-1">Verwacht Antwoord / Voorwaarde:</h4>
                                    <div class="bg-indigo-50 p-3 rounded border border-indigo-100">
                                        <code class="text-indigo-900 font-mono text-sm font-bold">{{ $part->success_condition }}</code>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t flex justify-between items-center">
                                <span class="text-xs text-gray-400">
                                    <i class="fa-solid fa-comment-dots mr-1"></i> {{ $part->answers->count() }} antwoorden ingeleverd
                                </span>
                                <a href="{{ route('admin.parts.answers', ['quest' => $quest->id, 'part' => $part->id]) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                                    Details bekijken →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

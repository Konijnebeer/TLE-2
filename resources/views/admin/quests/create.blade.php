{{--<x-app-layout>--}}
{{--    <section class="max-w-4xl mx-auto py-8 px-4">--}}
{{--        <h1 class="text-2xl font-bold mb-6">Nieuwe Quest Maken</h1>--}}

{{--        <form method="POST" action="{{ route('admin.quests.store') }}" class="space-y-6">--}}
{{--            @csrf--}}

{{--            <div class="bg-white p-6 border rounded shadow-sm space-y-4">--}}
{{--                <h2 class="font-bold text-indigo-600">Quest Informatie</h2>--}}

{{--                <input name="name" type="text" placeholder="Naam" class="w-full border-gray-300 rounded" required />--}}
{{--                <textarea name="description" placeholder="Beschrijving" class="w-full border-gray-300 rounded" required></textarea>--}}

{{--                <div class="grid grid-cols-2 gap-4">--}}
{{--                    <input name="difficulty_level" type="number" min="1" max="5" value="1" class="border-gray-300 rounded" />--}}

{{--                    <select name="category" class="border-gray-300 rounded" required>--}}
{{--                        <option value="">Kies een categorie...</option>--}}
{{--                        @foreach(App\Enums\QuestCategory::cases() as $category)--}}
{{--                            <option value="{{ $category->value }}">{{ $category->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="bg-white p-6 border rounded shadow-sm space-y-4">--}}
{{--                <h2 class="font-bold text-indigo-600">Stappen</h2>--}}
{{--                <div id="parts-container" class="space-y-4">--}}
{{--                    <div class="p-4 bg-gray-50 border rounded">--}}
{{--                        <input name="parts[0][name]" type="text" placeholder="Titel stap" class="w-full border-gray-300 rounded mb-2" required />--}}
{{--                        <textarea name="parts[0][description]" placeholder="Uitleg" class="w-full border-gray-300 rounded mb-2" required></textarea>--}}
{{--                        <input name="parts[0][success_condition]" type="text" placeholder="Conditie (bijv: done)" class="w-full border-blue-200 rounded bg-blue-50" required />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button type="button" onclick="addPart()" class="text-indigo-600 text-sm font-bold">+ Stap toevoegen</button>--}}
{{--            </div>--}}

{{--            <div class="flex justify-end">--}}
{{--                <x-button type="submit">Quest Opslaan</x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </section>--}}

{{--    <script>--}}
{{--        let count = 1;--}}
{{--        function addPart() {--}}
{{--            const container = document.getElementById('parts-container');--}}
{{--            const html = `--}}
{{--                <div class="p-4 bg-gray-50 border rounded mt-4">--}}
{{--                    <input name="parts[${count}][name]" type="text" placeholder="Titel stap" class="w-full border-gray-300 rounded mb-2" required />--}}
{{--                    <textarea name="parts[${count}][description]" placeholder="Uitleg" class="w-full border-gray-300 rounded mb-2" required></textarea>--}}
{{--                    <input name="parts[${count}][success_condition]" type="text" placeholder="Conditie" class="w-full border-blue-200 rounded bg-blue-50" required />--}}
{{--                </div>`;--}}
{{--            container.insertAdjacentHTML('beforeend', html);--}}
{{--            count++;--}}
{{--        }--}}
{{--    </script>--}}
{{--</x-app-layout>--}}

{{--<?php--}}

{{--namespace App\Http\Controllers;--}}

{{--use App\Models\Quest;--}}
{{--use App\Models\Part;--}}
{{--use App\Http\Requests\StoreQuestRequest;--}}
{{--use Illuminate\Http\Request;--}}
{{--use Illuminate\Support\Facades\DB;--}}

{{--class QuestController extends Controller--}}
{{--{--}}
{{--    /**--}}
{{--     * Overzicht van alle Quests voor de admin.--}}
{{--     */--}}
{{--    public function index()--}}
{{--    {--}}
{{--        $quests = Quest::latest()->paginate(10);--}}
{{--        return view('admin.quests.index', compact('quests'));--}}
{{--    }--}}

{{--    /**--}}
{{--     * Toon het formulier om een nieuwe Quest te maken.--}}
{{--     */--}}
{{--    public function create()--}}
{{--    {--}}
{{--        return view('admin.quests.create');--}}
{{--    }--}}

{{--    /**--}}
{{--     * Sla de Quest en alle bijbehorende Parts (stappen) op.--}}
{{--     */--}}
{{--    public function store(StoreQuestRequest $request)--}}
{{--    {--}}
{{--        // Haal de gevalideerde data op uit je StoreQuestRequest--}}
{{--        $validated = $request->validated();--}}

{{--        try {--}}
{{--            DB::transaction(function () use ($validated, $request) {--}}
{{--                // 1. Maak de Quest aan--}}
{{--                $quest = Quest::create([--}}
{{--                    'name' => $validated['name'],--}}
{{--                    'description' => $validated['description'],--}}
{{--                    'difficulty_level' => $validated['difficulty_level'],--}}
{{--                    'category' => $validated['category'],--}}
{{--                    'is_active' => $request->has('is_active'),--}}
{{--                ]);--}}

{{--                // 2. Maak de onderdelen (Parts) aan die bij deze Quest horen--}}
{{--                foreach ($validated['parts'] as $index => $partData) {--}}
{{--                    $quest->parts()->create([--}}
{{--                        'order_index' => $index + 1,--}}
{{--                        'name' => $partData['name'],--}}
{{--                        'description' => $partData['description'],--}}
{{--                        'success_condition' => $partData['success_condition'],--}}
{{--                    ]);--}}
{{--                }--}}
{{--            });--}}

{{--            return redirect()->route('admin.quests.index')--}}
{{--                ->with('success', 'Quest en alle stappen zijn succesvol opgeslagen!');--}}

{{--        } catch (\Exception $e) {--}}
{{--            // Als er toch iets misgaat, krijg je een duidelijke foutmelding--}}
{{--            return back()->withInput()->withErrors(['error' => 'Database fout: ' . $e->getMessage()]);--}}
{{--        }--}}
{{--    }--}}

{{--    /**--}}
{{--     * CODE VAN TEAMGENOOT: Toon een specifieke quest.--}}
{{--     */--}}
{{--    public function show(Quest $quest)--}}
{{--    {--}}
{{--        $firstPart = $quest->parts()->orderBy('order_index')->first();--}}
{{--        return view('quest.show', compact('quest', 'firstPart'));--}}
{{--    }--}}
{{--}--}}

<x-app-layout>
    <section class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 border-b pb-4">Nieuwe Quest Bouwen</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.quests.store') }}" class="space-y-8">
            @csrf

            <div class="bg-white p-6 border border-gray-300 rounded-lg shadow-sm">
                <h2 class="font-bold mb-4 text-indigo-600 border-b pb-2 uppercase text-sm">1. Quest Gegevens</h2>
                <div class="grid gap-4">
                    <div>
                        <x-input-label for="name" value="Quest Naam" />
                        <input id="name" name="name" type="text" placeholder="Bijv: De Verborgen Tuin" class="w-full border-gray-300 rounded mt-1" value="{{ old('name') }}" required />
                    </div>
                    <div>
                        <x-input-label for="description" value="Beschrijving / Verhaal" />
                        <textarea id="description" name="description" placeholder="Uitleg over de quest..." class="w-full border-gray-300 rounded mt-1" rows="3" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="difficulty_level" value="Moeilijkheid (1-5)" />
                            <input id="difficulty_level" name="difficulty_level" type="number" min="1" max="5" value="{{ old('difficulty_level', 1) }}" class="w-full border-gray-300 rounded mt-1" />
                        </div>
                        <div>
                            <x-input-label for="category" value="Categorie" />
                            <select id="category" name="category" class="w-full border-gray-300 rounded mt-1" required>
                                <option value="">Kies een categorie...</option>
                                @foreach(\App\Enums\QuestCategory::cases() as $category)
                                    <option value="{{ $category->value }}" {{ old('category') == $category->value ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 border border-gray-300 rounded-lg shadow-sm">
                <h2 class="font-bold mb-4 text-indigo-600 border-b pb-2 uppercase text-sm">2. Stappen (Parts)</h2>
                <div id="parts-container" class="space-y-4">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded group relative">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Stap 1</span>
                        <input name="parts[0][name]" type="text" placeholder="Titel van deze stap" class="w-full border-gray-300 rounded mb-2 mt-1" required />
                        <textarea name="parts[0][description]" placeholder="Wat moet de leerling doen?" class="w-full border-gray-300 rounded mb-2 text-sm" required></textarea>
                        <input name="parts[0][success_condition]" type="text" placeholder="Conditie (bijv: timer:60s of done)" class="w-full border-blue-200 rounded text-sm bg-blue-50" required />
                    </div>
                </div>
                <button type="button" onclick="addPart()" class="mt-4 text-indigo-600 font-bold text-xs hover:underline uppercase tracking-widest">
                    + Voeg nog een stap toe
                </button>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-indigo-600 shadow-sm">
                    <span class="text-sm font-medium text-gray-700">Zet quest direct live</span>
                </label>
                <x-button type="submit" class="!w-auto px-10">
                    Quest Opslaan
                </x-button>
            </div>
        </form>
    </section>

    <script>
        let count = 1;
        function addPart() {
            const container = document.getElementById('parts-container');
            const div = document.createElement('div');
            div.className = "p-4 bg-gray-50 border border-gray-200 rounded mt-4 animate-fadeIn";
            div.innerHTML = `
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Stap \${count + 1}</span>
                <input name="parts[\${count}][name]" type="text" placeholder="Titel stap" class="w-full border-gray-300 rounded mb-2 mt-1" required />
                <textarea name="parts[\${count}][description]" placeholder="Uitleg..." class="w-full border-gray-300 rounded mb-2 text-sm" required></textarea>
                <input name="parts[\${count}][success_condition]" type="text" placeholder="Conditie" class="w-full border-blue-200 rounded text-sm bg-blue-50" required />
            `;
            container.appendChild(div);
            count++;
        }
    </script>
</x-app-layout>

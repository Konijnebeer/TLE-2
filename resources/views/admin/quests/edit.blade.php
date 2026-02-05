<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Quest Aanpassen</h1>
            <a href="{{ route('admin.quests.show', $quest) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                <i class="fa-solid fa-xmark mr-1"></i> Annuleren
            </a>
        </div>

        <form action="{{ route('admin.quests.update', $quest) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 shadow-sm rounded-xl border border-gray-100">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Configuratie</h2>

                        <div class="space-y-5">
                            <div>
                                <x-input-label for="name" value="Naam van de Quest" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $quest->name)" required />
                            </div>

                            <div>
                                <x-input-label for="category" value="Categorie" />
                                <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach(\App\Enums\QuestCategory::cases() as $category)
                                        <option value="{{ $category->value }}" {{ old('category', $quest->category->value ?? $quest->category) == $category->value ? 'selected' : '' }}>
                                            {{ ucfirst($category->value) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="difficulty_level" value="Niveau (1-5)" />
                                    <x-text-input id="difficulty_level" name="difficulty_level" type="number" class="mt-1 block w-full" :value="old('difficulty_level', $quest->difficulty_level)" min="1" max="5" required />
                                </div>
                                <div class="flex items-center justify-end mt-6">
                                    <label for="is_active" class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm" {{ $quest->is_active ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm font-bold text-gray-600 uppercase">Actief</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 shadow-sm rounded-xl border border-gray-100">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Introductie</h2>
                        <textarea id="description" name="description" rows="5" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Vertel het begin van het verhaal..." required>{{ old('description', $quest->description) }}</textarea>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-xl font-bold text-gray-800">Quest Onderdelen</h2>
                        <button type="button" onclick="addPart()" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-indigo-700 transition">
                            <i class="fa-solid fa-plus mr-2"></i> Stap Toevoegen
                        </button>
                    </div>

                    <div id="parts-container" class="space-y-4">
                        @foreach($quest->parts->sortBy('order_index') as $index => $part)
                            <div class="part-item bg-white p-6 shadow-sm rounded-xl border border-gray-100 border-l-4 border-indigo-500">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold uppercase text-gray-400">Naam van de stap</label>
                                        <input type="text" name="parts[{{ $index }}][name]" value="{{ $part->name }}" class="w-full border-gray-300 rounded-md mt-1 text-sm font-bold" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold uppercase text-gray-400">Instructie / Vraag voor de leerling</label>
                                        <textarea name="parts[{{ $index }}][description]" rows="2" class="w-full border-gray-300 rounded-md mt-1 text-sm" required>{{ $part->description }}</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold uppercase text-indigo-400">Correct Antwoord (Check)</label>
                                        <input type="text" name="parts[{{ $index }}][success_condition]" value="{{ $part->success_condition }}" class="w-full border-indigo-100 bg-indigo-50 rounded-md mt-1 text-sm font-mono font-bold text-indigo-700" required>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button type="button" onclick="this.closest('.part-item').remove()" class="inline-flex items-center px-3 py-1.5 border border-red-200 text-red-600 text-[10px] font-bold uppercase rounded-md hover:bg-red-50 transition">
                                        <i class="fa-solid fa-trash-can mr-2"></i> Stap Verwijderen
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 shadow-lg z-10">
                <div class="max-w-7xl mx-auto flex justify-end gap-4">
                    <a href="{{ route('admin.quests.show', $quest) }}" class="px-6 py-2 text-sm font-bold text-gray-500 hover:text-gray-800 transition flex items-center">
                        Annuleren
                    </a>
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                        Quest Opslaan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let partIndex = {{ $quest->parts->count() }};

        function addPart() {
            const container = document.getElementById('parts-container');
            const html = `
                <div class="part-item bg-white p-6 shadow-sm rounded-xl border border-gray-100 border-l-4 border-green-500 animate-fadeIn">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase text-gray-400">Naam van de nieuwe stap</label>
                            <input type="text" name="parts[${partIndex}][name]" class="w-full border-gray-300 rounded-md mt-1 text-sm font-bold" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase text-gray-400">Instructie / Vraag</label>
                            <textarea name="parts[${partIndex}][description]" rows="2" class="w-full border-gray-300 rounded-md mt-1 text-sm" required></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase text-indigo-400">Correct Antwoord</label>
                            <input type="text" name="parts[${partIndex}][success_condition]" class="w-full border-indigo-100 bg-indigo-50 rounded-md mt-1 text-sm font-mono font-bold text-indigo-700" required>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="this.closest('.part-item').remove()" class="inline-flex items-center px-3 py-1.5 border border-red-200 text-red-600 text-[10px] font-bold uppercase rounded-md hover:bg-red-50 transition">
                            <i class="fa-solid fa-trash-can mr-2"></i> Stap Verwijderen
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            partIndex++;
        }
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
    </style>
</x-app-layout>

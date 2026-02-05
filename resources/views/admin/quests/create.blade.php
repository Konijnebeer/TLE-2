<x-app-layout>
    <section class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 border-b pb-4">Nieuwe Quest Bouwen</h1>

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
                    <div class="part-item p-4 bg-gray-50 border rounded mt-4">
                        <input name="parts[0][name]" type="text" placeholder="Titel van deze stap" class="w-full border-gray-300 rounded mb-2 mt-1" required />
                        <textarea name="parts[0][description]" placeholder="Wat moet de leerling doen?" class="w-full border-gray-300 rounded mb-2 text-sm" required></textarea>
                        <input name="parts[0][success_condition]" type="hidden" value="done" />
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
            div.className = "part-item p-4 bg-gray-50 border rounded mt-4 animate-fadeIn";
            div.innerHTML = `
                <input name="parts[${count}][name]" type="text" placeholder="Titel van deze stap" class="w-full border-gray-300 rounded mb-2 mt-1" required />
                <textarea name="parts[${count}][description]" placeholder="Wat moet de leerling doen?" class="w-full border-gray-300 rounded mb-2 text-sm" required></textarea>
                <input name="parts[${count}][success_condition]" type="hidden" value="done" />

                <div class="flex justify-end mt-2">
                    <button type="button" onclick="this.closest('.part-item').remove()" class="text-red-500 hover:text-red-700 text-xs font-bold uppercase tracking-widest">
                        Verwijder Stap
                    </button>
                </div>
            `;
            container.appendChild(div);
            count++;
        }
    </script>
</x-app-layout>

@php use App\Enums\QuestCategory; @endphp
<x-app-layout>

    <section class="max-w-2xl">
        <div class="mb-4">
            <a href="{{ route('quests.index') }}">
                <x-button variant="transparent" size="small" :arrow="false">
                    ← Terug naar questenoverzicht
                </x-button>
            </a>
        </div>

        <h1 class="mb-4">Creëer Nieuwe Quest</h1>

        <form action="{{ route('quests.store') }}" method="POST" class="border border-gray-300 p-4 rounded-lg">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-2 font-bold">
                    Quest name <span class="text-red-600">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    minlength="3"
                    maxlength="100"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    placeholder="Enter quest name (3-100 characters)"
                >
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2 font-bold">
                    Beschrijving <span class="text-red-600">*</span>
                </label>
                <textarea
                    id="description"
                    name="description"
                    required
                    minlength="10"
                    maxlength="300"
                    rows="5"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    placeholder="Enter quest description (10-300 characters)"
                >{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="difficulty_level" class="block mb-2 font-bold">
                    Moeilijkheidsgraad <span class="text-red-600">*</span>
                </label>
                <select
                    id="difficulty_level"
                    name="difficulty_level"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2"

                >
                    >
                    <option class="text-black" disabled
                            value="" {{ old('difficulty_level') == null ? 'selected' : '' }}>
                        Kies uw moeilijkheidsgraad
                    </option>
                    <option value="1" {{ old('difficulty_level') == "1" ? 'selected' : '' }}>
                        Makkelijk
                    </option>

                    <option value="2" {{ old('difficulty_level') == "2" ? 'selected' : '' }}>
                        Gemiddeld
                    </option>

                    <option value="3" {{ old('difficulty_level') == "3" ? 'selected' : '' }}>
                        Moeilijk

                    </option>
                </select>
                @error('difficulty-level')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block mb-2 font-bold">
                    Categorie <span class="text-red-600">*</span>
                </label>
                <select
                    id="category"
                    name="category"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2"

                >
                    >
                    <option class="text-black" disabled
                            value="" {{ old('category') == null ? 'selected' : '' }}>
                        Kies uw categorie
                    </option>

                    @foreach(QuestCategory::cases() as $category)

                        <option
                            value="{{$category->value}}" {{ old('category') == $category->value ? 'selected' : '' }}>
                            {{ucfirst($category->value)}}
                        </option>

                    @endforeach


                </select>
                @error('difficulty-level')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex gap-2">
                <button type="submit">
                    <x-button variant="primary" size="small" :arrow="false">
                        Creëer quest
                    </x-button>
                </button>
                <a href="{{ route('quests.index') }}">
                    <x-button variant="transparent" size="small" :arrow="false">
                        Annuleren
                    </x-button>
                </a>
            </div>
        </form>
    </section>


</x-app-layout>

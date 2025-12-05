<x-app-layout>
    <section class="max-w-2xl">
        @can('viewAny', App\Models\Group::class)
            <div class="mb-4">
                <a href="{{ route('groups.index') }}">
                    <x-button variant="transparent" size="small" :arrow="false">
                        ← Terug naar Klassen
                    </x-button>
                </a>
            </div>
        @endcan

        <h1 class="mb-4">Creëer Nieuwe Klas</h1>

        <form action="{{ route('groups.store') }}" method="POST" class="border border-gray-300 p-4 rounded-lg">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-2 font-bold">
                    Klas Naam <span class="text-red-600">*</span>
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
                    placeholder="Enter group name (3-100 characters)"
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
                    placeholder="Enter group description (10-300 characters)"
                >{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit">
                    <x-button variant="primary" size="small" :arrow="false">
                        Creëer Kllas
                    </x-button>
                </button>
                <a href="{{ route('groups.index') }}">
                    <x-button variant="transparent" size="small" :arrow="false">
                        Anuleer
                    </x-button>
                </a>
            </div>
        </form>
    </section>
</x-app-layout>

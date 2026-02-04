<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Quest Details</h1>
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-2">{{ $quest->name }}</h2>
            <p class="mb-4 text-gray-700">{{ $quest->description }}</p>
            <div class="mb-2">
                <span class="font-semibold">Categorie:</span>
                {{ ucfirst($quest->category) }}
            </div>
            <div class="mb-2">
                <span class="font-semibold">Moeilijkheidsgraad:</span>
                {{ $quest->difficulty_level }}
            </div>
            <div class="mb-2">
                <span class="font-semibold">Status:</span>
                <span class="px-2 py-1 text-xs rounded-full {{ $quest->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                </span>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.quests.edit', $quest) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Bewerken</a>
            </div>
        </div>
    </div>
</x-app-layout>


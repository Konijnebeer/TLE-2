<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Quest Beheer</h1>
            <a href="{{ route('admin.quests.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-bold">
                + Nieuwe Quest
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Naam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acties</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($quests as $quest)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quest->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quest->category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $quest->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.quests.show', $quest) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Bekijken</a>
                            <form action="{{ route('admin.quests.destroy', $quest) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-900">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Er zijn nog geen quests gevonden in de database.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $quests->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

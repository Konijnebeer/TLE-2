<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Quest Beheer</h1>
            <a href="{{ route('admin.quests.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-bold shadow hover:bg-indigo-700 transition">
                + Nieuwe Quest
            </a>
        </div>

        @if(session('success'))
            <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm transition-opacity duration-500">
                {{ session('success') }}
            </div>

            <script>
                // Verberg de melding automatisch na 3 seconden
                setTimeout(() => {
                    const msg = document.getElementById('flash-message');
                    if (msg) {
                        msg.style.opacity = '0';
                        setTimeout(() => msg.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="bg-white shadow overflow-x-auto sm:rounded-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($quests as $quest)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $quest->name }}</div>
                            <div class="text-xs text-gray-400">{{ $quest->category }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $quest->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                <a href="{{ route('admin.quests.edit', $quest) }}" class="inline-flex items-center w-full px-2 py-1 bg-yellow-500 text-white rounded text-xs font-semibold shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition justify-center" title="Bewerken">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                                    Bewerken
                                </a>
                                <a href="{{ route('admin.quests.show', $quest) }}" class="inline-flex items-center w-full px-2 py-1 bg-indigo-600 text-white rounded text-xs font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition justify-center" title="Bekijk quest">
                                    <i class="fa-solid fa-eye mr-1"></i>
                                    Bekijken
                                </a>
                                <form action="{{ route('admin.quests.destroy', $quest) }}"
                                      method="POST"
                                      class="inline w-full"
                                      onsubmit="return confirm('Weet je zeker dat je de quest \'{{ $quest->name }}\' wilt verwijderen? Dit kan niet ongedaan worden gemaakt.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center w-full px-2 py-1 bg-red-600 text-white rounded text-xs font-semibold shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition justify-center" title="Verwijderen">
                                        <i class="fa-solid fa-trash mr-1"></i>
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">
                            Er zijn nog geen quests gevonden in de database.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($quests->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $quests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

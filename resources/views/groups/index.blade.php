<x-app-layout>
    <section>
        <h1 class="text-center">Klassen</h1>

        @if($groups->isEmpty())
            <p>Geen klassen gevonden.</p>
        @else
            <div class="grid gap-4 mb-8">
                @foreach ($groups as $group)
                    <div class="border border-gray-300 p-4 rounded-lg">
                        <h2 class="mb-2">{{ $group->name }}</h2>

                        <p class="mb-4 text-gray-600">
                            {{ $group->description ?? 'No description available.' }}
                        </p>

                        <div class="mb-4">
                            <strong>Members:</strong> {{ $group->total_users_count }} Totaal
                            <ul class="mt-2 ml-6 list-disc">
                                <li>Leeraren: {{ $group->owners_count }}</li>
                                <li>Leerlingen: {{ $group->members_count }}</li>
                                <li>Gasten: {{ $group->guests_count }}</li>
                            </ul>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('groups.show', $group) }}"
                               class="w-full">
                                <x-button variant="primary" size="small" :arrow="false">
                                    Bekijk
                                </x-button>
                            </a>

                            @can('delete', $group)
                                <form action="{{ route('groups.destroy', $group) }}" method="POST"
                                      class="inline w-full"
                                      onsubmit="return confirm('Weet je zeker dat je de klas wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-button variant="secondary" size="small" :arrow="false">
                                        Verwijder
                                    </x-button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $groups->links() }}
            </div>
        @endif
    </section>
</x-app-layout>

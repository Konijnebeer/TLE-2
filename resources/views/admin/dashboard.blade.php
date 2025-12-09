<x-app-layout>
    <section class="max-w-4xl">
        <h1 class="mb-6 text-center">Admin Dashboard</h1>

        <div class="grid gap-4">
            <!-- Users Management Card -->
            <a href="{{ route('admin.users.index') }}" class="block">
                <div class="border border-gray-300 p-6 rounded-lg hover:bg-gray-50 transition">
                    <h2 class="mb-2 text-xl">Gebruikersbeheer</h2>
                    <p class="text-gray-600">Bekijk en beheer alle gebruikers, wijzig rollen en verwijder accounts.</p>
                </div>
            </a>

            <!-- Groups Management Card -->
            <a href="{{ route('groups.index') }}" class="block">
                <div class="border border-gray-300 p-6 rounded-lg hover:bg-gray-50 transition">
                    <h2 class="mb-2 text-xl">Klassenbeheer</h2>
                    <p class="text-gray-600">Beheer alle klassen, bekijk leden en bewerk instellingen.</p>
                </div>
            </a>

            <!-- Quests Management Card -->
            <a href="{{ route('quests.index') }}" class="block">
                <div class="border border-gray-300 p-6 rounded-lg hover:bg-gray-50 transition">
                    <h2 class="mb-2 text-xl">Quest Beheer</h2>
                    <p class="text-gray-600">Maak, bewerk en verwijder quests en hun onderdelen.</p>
                </div>
            </a>
        </div>
    </section>
</x-app-layout>


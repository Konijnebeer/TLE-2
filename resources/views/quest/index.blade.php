<x-app-layout>
    <section
        id="mainSection"
        class="bg-[url('/public/images/hooglander.png')] h-[calc(100vh-175px)] bg-no-repeat bg-cover bg-center overflow-hidden"
    >
        <h1 class="text-black m-4 text-center text-sm">Questenoverzicht</h1>
        <div class="flex flex-col justify-around items-center">
            @foreach($quests as $quest)
                <div class="flex justify-between p-2 flex-col bg-white border-2 border-solid border-black min-h-210 min-w-280 max-h-220 max-w-280">
                    <h2>{{$quest->name}}</h2>

                    <form action="{{ route('admin.quests.activity', $quest) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                class="px-4 py-2 rounded-full text-secondary font-bold transition-colors duration-200 {{ $quest->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">

                            <div class="flex items-center gap-2">

                                {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                            </div>
                        </button>
                    </form>

                    <form action="{{ route('quests.edit', $quest) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                                class="px-4 py-2 rounded-full text-secondary font-bold transition-colors duration-200 ">

                            <div class="flex items-center gap-2">
                                Bewerken
                            </div>
                        </button>
                    </form>

                    <form action="{{ route('quests.destroy', $quest) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 rounded-full text-secondary font-bold transition-colors duration-200">

                            <div class="flex items-center gap-2">
                                Verwijderen
                            </div>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>

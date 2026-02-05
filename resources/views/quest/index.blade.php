<x-app-layout>
    <section
        id="mainSection"
        class="bg-[url('/public/images/hooglander.png')] min-h-[calc(100vh-175px)] bg-no-repeat bg-cover bg-center overflow-y-auto"
    >
        <div class="flex flex-col justify-center items-center p-4">
            <h1 class="text-black m-4 text-center text-xl font-light">Questenoverzicht</h1>
            <a href="{{ route('quests.create') }}"
               class="w-full px-4 py-2 rounded-2 text-white bg-[#E2006A] text-center font-bold transition-colors duration-200 border-2 hover:text-[#E2006A]  hover:bg-gray-100">
                Aanmaken
            </a>
        </div>
        <div class="flex flex-wrap justify-center items-stretch gap-4 p-4">

            @foreach($quests as $quest)
                <a href="{{ route('admin.quests.show', $quest) }}"
                   class=" hover:cursor-pointer ">
                    <div
                        class="flex flex-col justify-between p-4  sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full flex-grow-0">

                        <h2 class="text-center mb-4">{{$quest->name}}</h2>

                        <div class="flex flex-col gap-3">

                            <form action="{{ route('admin.quests.activity', $quest) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full z-10 px-4 py-2 rounded-2 font-bold transition-colors duration-200 border-2 border-transparent {{ $quest->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                    {{ $quest->is_active ? 'Actief' : 'Inactief' }}
                                </button>
                            </form>

                            <a href="{{ route('quests.edit', $quest) }}"
                               class="w-full px-4 z-10 py-2 rounded-2 text-center font-bold transition-colors duration-200 border-2 border-black hover:bg-gray-100">
                                Bewerken
                            </a>

                            <form action="{{ route('quests.destroy', $quest) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full z-10 px-4 py-2 rounded-2 font-bold transition-colors duration-200 border-2 border-black hover:bg-red-50 text-red-600">
                                    Verwijderen
                                </button>
                            </form>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>

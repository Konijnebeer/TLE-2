<section class="space-y-6">
    <header class="flex flex-col gap-2">
        <h2 class="text-lg font-medium text-[--color-black]">
            {{ __('Klassen') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Zie hier je klassen, voeg nieuwe toe of ga uit bestaande klassen.') }}
        </p>
    </header>

    @if (session('status') === 'group-joined')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-green-600"
        >{{ __('Je bent succesvol toegevoegd aan de klas.') }}</p>
    @endif

    @if (session('status') === 'group-left')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-green-600"
        >{{ __('Je hebt de klas succesvol verlaten.') }}</p>
    @endif

    @if (session('error'))
        <p class="text-sm text-red-600">{{ session('error') }}</p>
    @endif

    <!-- Current Groups -->
    <div class="space-y-4">
        <h3 class="text-md font-medium text-[--color-black]">
            {{ __('Jouw klassen') }}
        </h3>

        @if ($groups->isEmpty())
            <p class="text-sm text-gray-600">
                {{ __('Je zit nog niet in een klas. Gebruik een klascode om lid te worden.') }}
            </p>
        @else
            <div class="space-y-3">
                @foreach ($groups as $group)
                    <a href="{{ route('groups.show', $group) }}" class="block">
                        <div class="flex flex-col p-4 border border-gray-200 rounded-lg space-y-3">
                            <div>
                                <h4 class="font-medium text-[--color-black]">{{ $group->name }}</h4>
                                @if ($group->description)
                                    <p class="text-sm text-gray-600">{{ $group->description }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ __('Rol') }}:
                                    @switch($group->pivot->role->value)
                                        @case('owner')
                                            <span class="font-medium">{{ __('Leeraar') }}</span>
                                            @break
                                        @case('member')
                                            <span class="font-medium">{{ __('Leerling') }}</span>
                                            @break
                                        @case('guest')
                                            <span class="font-medium">{{ __('Gast') }}</span>
                                            @break
                                    @endswitch
                                </p>
                            
                            </div>

                            @if ($group->pivot->role->value !== 'owner')
                                <form method="post" action="{{ route('profile.groups.leave', $group) }}" class="w-full">
                                    @csrf
                                    @method('delete')
                                    <x-button
                                        type="submit"
                                        variant="secondary"
                                        size="small"
                                        :arrow="false"
                                        onclick="return confirm('Weet je zeker dat je deze klas wilt verlaten?')"
                                        class="w-full"
                                    >
                                        {{ __('Verlaten') }}
                                    </x-button>
                                </form>
                            @else
                                <span
                                    class="text-xs text-gray-500 text-center">{{ __('(Kan niet verlaten als eigenaar)') }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Join Group Form -->
    <div class="space-y-4">
        <h3 class="text-md font-medium text-[--color-black]">
            {{ __('Nieuwe klas toevoegen') }}
        </h3>

        <form method="post" action="{{ route('profile.groups.join') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="code" :value="__('Klascode')"/>
                <x-text-input
                    id="code"
                    name="code"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('code')"
                    placeholder="Voer de klascode in"
                />
                <x-input-error class="mt-2" :messages="$errors->get('code')"/>
            </div>

            <div class="flex items-center gap-4">
                <x-button size="small" :arrow="false">{{ __('Deelnemen aan klas') }}</x-button>
            </div>
        </form>
        @can('create', App\Models\Group::class)
            <a href="{{ route('groups.create') }}">
                <x-button size="small" class="mt-2">
                    Maak nieuwe klas aan
                </x-button>
            </a>
        @endcan
    </div>

</section>

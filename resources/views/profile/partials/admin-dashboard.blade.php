<section class="space-y-2">
    <header class="flex flex-col gap-2">
        <h2 class="text-lg font-medium text-[--color-black]">
            {{ __('Admin Dashboard') }}
        </h2>

        <p class="mt-1 text-sm">
            Ga hier naar Admin pagina's
        </p>
    </header>
    <div class="space-y-4">
        <a href="{{ route('admin.dashboard') }}">
            <x-button size="small" class="mb-2">
                Dashboard
            </x-button>
        </a>
    </div>
</section>

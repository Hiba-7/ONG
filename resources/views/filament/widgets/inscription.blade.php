<h1 class="text-2xl font-bold tracking-tight md:text-xl filament-header-heading capitalize"> Inscription</h1>


<x-filament::widget class="grid sm:grid-cols-3 lg:grid-cols-6 gap-4  lg:col-span-full filament-stats">
    <x-filament::card
        class=" relative p-5 rounded-2xl bg-white shadow filament-stats-card dark:bg-gray-800
    filament-stats-overview-widget-card">
        <header class=" text-sm font-medium text-gray-500 dark:text-gray-200">
            {{ 'Sans niveau ' }}

        </header>
        <div class="text-3xl ">
            {{ $sansniv }}
        </div>

    </x-filament::card>
    @foreach ($formations as $formation)
        <x-filament::card
            class=" relative p-5 rounded-2xl bg-white shadow filament-stats-card dark:bg-gray-800
            filament-stats-overview-widget-card">
            <header class=" text-sm font-medium text-gray-500 dark:text-gray-200">
                {{ 'Niveau ' . $formation->niveau }}

            </header>
            <div class="text-3xl ">
                {{ $formation->inscriptions }}
            </div>

        </x-filament::card>
    @endforeach
</x-filament::widget>

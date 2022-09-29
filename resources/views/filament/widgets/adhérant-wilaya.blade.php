<x-filament::widget class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:col-span-full">
    @foreach ($wilayas as $wilaya)
        <x-filament::card>
            <header class="text-lg text-gray-500 dark:text-gray-200 font-bold">
                {{ $wilaya->id . ' - ' . $wilaya->nom }}
            </header>
            <div>
                <div class="text-xs ">
                    Nombre d'adhérants :
                    {{ $wilaya->adhérants }}

                </div>

                <div class="text-xs ">
                    Communes occupées :
                    {{ $wilaya->adhérants()->count() }}
                    /
                    {{ $wilaya->communes()->count() }}
                </div>
                <div class="text-xs ">
                    Moyenne adhérants/commune :
                    {{ number_format($wilaya->adhérants()->count() / $wilaya->communesTot, 2, '.', ',') }}

                </div>
                <div class="text-xs ">
                    Hommes :
                    {{ $wilaya->hommes }}

                </div>
                <div class="text-xs ">
                    Femmes :
                    {{ $wilaya->femmes }}
                </div>


            </div>
        </x-filament::card>
    @endforeach
</x-filament::widget>

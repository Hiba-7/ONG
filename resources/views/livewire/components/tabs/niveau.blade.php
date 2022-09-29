{{-- show the description then a table --}}
<section class="h-full w-full">
    <section class="h-1/4 w-full flex flex-col rounded-md bg-white shadow-lg">
        @if (!$inscrit)
            <div class="h-1/4 w-full flex justify-between items-center rounded-md  mb-2 px-10">
                <h3 class="text-2xl">Niveau {{ $numero }}</h3>
                <x-button class="hover:cursor-pointer " wire:click="inscriptionClickHandler">Inscriez vous
                </x-button>

            </div>
            <hr class="w-full border-gray-50">


            <div>
                <p class="text-lg text-gray-700 py-5 px-10">
                    {{ $description }}
                </p>
            </div>
        @else
            <div class="h-full w-full flex items-center justify-center gap-6 p-6 relative">
                @svg('codicon-lock', 'h-32 w-32 text-blue-500')
                <div class="text-center">
                    <h3 class="text-2xl">Vous êtes inscrit au niveau {{ $numero }}</h3>
                    <p class="text-lg text-gray-700 py-5 px-10">
                        vous pouvez consulter les planifications du niveau {{ $numero }} ou bien vous désinscrire
                    </p>
                </div>
                <x-button class="absolute top-3 right-5" wire:click="desinscriptionClickHandler">Désinscrire
                </x-button>
            </div>
        @endif
    </section>
    <section class="mt-4">
        {{-- <h3 class="text-2xl text-center"></h3> --}}
        <h3 class="text-2xl text-center">les planifications du niveau {{ $numero }}</h3>
        <div class="mt-4">{{ $this->table }}</div>
    </section>
</section>

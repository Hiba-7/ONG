{{-- <div class="grid p-9 xl:grid-cols-4 sm:grid-cols-1 gap-2">
    <h1 class="sm:col-span-4 text-5xl font-bold text-blue-600 text-center">{{ Str::slug($instance_nom) }}</h1>
    @foreach ($postes as $poste)
        <livewire:components.poste-card :poste="$poste" :instance_nom="$instance_nom" />
    @endforeach
</div> --}}
<div class="flex flex-col p-3 gap-3 overflow-y-auto justify-center h-full">
    @if ($users->isEmpty())
        <x-vide>
            Aucun utilisateur trouvé
        </x-vide>
    @else
        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <li>
                        <livewire:components.user-card :user="$user" />
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            {{ $users->links() }}
        </div>
    @endif

</div>

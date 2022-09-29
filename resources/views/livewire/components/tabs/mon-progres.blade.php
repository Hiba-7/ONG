<div class="w-full h-full p-12">
    @if ($vide)
        <x-vide>
            Vous n'etes inscrit a aucune formation.
        </x-vide>
    @else
        {{ $this->table }}
    @endif
</div>

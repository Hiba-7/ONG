<div class="pt-100 bg-white shadow overflow-hidden sm:rounded-lg w-[87%]">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Cotisations</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Année {{ now()->year }}</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            @foreach ($current_cotisations as $cotisation)
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Cotisation {{ ucfirst(explode('_', $cotisation->cotisation->type)[0])  }}</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                    @if ($cotisation->est_payée)
                        <x-tw.badge :content="'Complété'" :color="'green'"></x-tw.badge>
                    @else
                        <x-tw.badge :content="'En Attent'" :color="'yellow'"></x-tw.badge>
                    @endif

                </dd>
                <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-1"> {{ $cotisation->cotisation->montant  }} DZD</dd>


            </div>
            @endforeach

            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Historique de Paiment</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Année {{ now()->year }}</p>
            </div>
            <div class="mt-12 text-sm text-gray-900 sm:mt-0 overflow-auto">
                {{ $this->table }}
            </div>
        </dl>
    </div>
</div>

<div class="pt-100 bg-white shadow overflow-hidden sm:rounded-lg w-[87%]">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Cotisations</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Année {{ now()->year }}</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            @foreach ($current_paiements as $paiement)
                <div
                    class="py-4 sm:py-5 sm:grid place-items-stretch place-content-center sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Cotisation
                        {{ ucfirst(explode('_', $paiement->cotisation->type)[0]) }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        @if ($paiement->est_payée)
                            <x-tw.badge :color="'green'">
                                <x-heroicon-o-check-circle class="w-5 h-5 mr-1" />
                                Completée
                            </x-tw.badge>
                        @else
                            <x-tw.badge :color="'red'">
                                <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-1" />
                                En Attente
                            </x-tw.badge>
                        @endif

                    </dd>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-1">
                        {{ money($paiement->cotisation_total, $paiement->cotisation->type == 'simple_étranger' ? 'EUR' : 'DZD') }}
                    </dd>
                </div>
            @endforeach

            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Historique de Paiement</h3>
            </div>
            <div id="history_table">
                {{ $this->table }}
            </div>
        </dl>
    </div>
</div>
<style>
    #history_table .filament-tables-container {
        border-radius: 0px;
        box-shadow: none;
    }
</style>

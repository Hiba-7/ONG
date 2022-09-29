<div class="h-full w-[87%] flex flex-col gap-1">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Cotisations</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Année {{ now()->year }}</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Cotisation Simple
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 ">
                        {{ $est_payee ? 'Complétée' : 'En Attente' }}
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 ">
                        {{ $montant_simple }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Cotisation Spéciale
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $est_payee_speciale ? 'Complétée' : 'En Attente' }}
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $montant_speciale }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <h3 class="text-xl font-medium text-gray-500">
                        Historique des paiements
                    </h3>

                </div>


            </dl>

        </div>

    </div>
    <div class="mt-12 text-sm text-gray-900 sm:mt-0">
        {{ $this->table }}

    </div>
</div>

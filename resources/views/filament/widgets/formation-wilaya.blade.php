<h1 class="relative p-5  text-2xl font-bold tracking-tight md:text-xl filament-header-heading capitalize"> Les
    certifications par wilaya </h1>
<x-filament::widget class=" relative p-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:col-span-full">
    @foreach ($wilayas as $wilaya)
        <x-filament::card>
            <header class="text-lg text-gray-500 dark:text-gray-200 font-bold">
                {{ $wilaya->id . ' - ' . $wilaya->nom }}
            </header>
            <div>
                @foreach ($formations as $formation)
                    @php
                        
                    @endphp
                    <div class="text-xs ">
                        Niveau
                        {{ $formation->niveau }}
                        :
                        {{ $wilaya->users()->join('formation_user', 'users.id', '=', 'formation_user.user_id')->where('formation_user.certifié', '=', true)->where('formation_user.formation_id', '=', $formation->id)->count() }}

                    </div>
                @endforeach
            </div>
        </x-filament::card>
    @endforeach
</x-filament::widget>

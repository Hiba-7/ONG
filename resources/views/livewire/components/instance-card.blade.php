<div>
    <a href="{{ route('adresse.instance', ['instance_id' => $instance_id, 'instance_nom' => Str::snake($instance_nom)]) }}"
        class="block hover:bg-gray-50">
        <div class="grid grid-cols-3 px-4 py-4 sm:px-6">

            <p class="text-2xl col-span-2 text-center font-medium text-blue-600 truncate">{{ $instance_nom }}</p>



            <p class="flex items-center text-sm text-gray-500">
                <!-- Heroicon name: solid/users -->
                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                {{ $postes->count() }} postes - {{ $nbre_adherents }} adhérents
            </p>


        </div>
    </a>
</div>

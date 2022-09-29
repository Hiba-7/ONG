<div class="flex w-screen h-full justify-center items-center">
    {{-- refractor the next article so it routes to Admin --}}
    <article class="p-4 bg-gray-50 border border-gray-700 rounded-xl">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-16 h-16 rounded-full"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>


            <div class="ml-3">
                <h5 class="text-lg font-medium text-blue-700">{{ $user->nom . ' ' . $user->prénom }}</h5>
                <h6 class="text-sm font-medium text-gray-400">{{ $user->email }}</h6>
            </div>
        </div>

        <ul class="mt-4 space-y-2">
            @hasanyrole($needed_roles)
                <li>
                    <a href="{{ route('filament.pages.dashboard') }}"
                        class="block h-full p-4 border border-gray-700 rounded-lg hover:border-blue-600">
                        <h5 class="font-medium text-blue-700">Admin</h5>

                        <p class="mt-1 text-xs font-medium text-gray-600">
                            Vous avez le role {{ $roles }} vous
                            pouvez connecter
                            en
                            tant qu'administrateur
                        </p>
                    </a>
                </li>
            @endhasanyrole
            <li>
                <a href="{{ route('accueil') }}"
                    class="block h-full p-4 border border-gray-700 rounded-lg hover:border-blue-600">
                    <h5 class="font-medium text-blue-700">Adherent</h5>

                    <p class="mt-1 text-xs font-medium text-gray-600">
                        Connectez vous en tant qu'adherent
                    </p>
                </a>
            </li>
        </ul>
    </article>

    {{-- <div class="flex flex-col justify-center items-center">
        <a href="{{ route('filament.pages.dashboard') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Admin
            </button>
        </a>
        <a href="{{ route('accueil') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adherent
            </button>
        </a>
    </div> --}}
</div>

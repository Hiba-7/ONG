<x-guest-layout :padding="'8'">

    {{-- steps & logo --}}
    @include('auth.register.steps')

    {{-- register form --}}
    <div class="bg-white h-full w-full rounded-xl p-3 col-span-6 shadow-xl flex flex-col justify-center items-center">
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
        <form id="form" method="POST" class="w-full p-8 rounded-xl bg-gray-100" enctype="multipart/form-data"
            action="{{ route('register.step.three.post') }}">
            @csrf

            <h1 class="text-2xl mb-8 w-full">Entrer Les information de votre Carte Nationale</h1>

            {{-- numero carte nationale --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="numero" :value="__('Numero Carte Nationale')" />
                    <x-input :value="old('numero')" id="numero" class="block mt-1 w-full" type="text" name="numero" />
                    @error('numero')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-1">
                    <x-label for="lieu_delivrance" :value="__('Lieu de delivrance')" />
                    <x-input :value="old('lieu_delivrance')" id="lieu_delivrance" class="block mt-1 w-full" type="text"
                        name="lieu_delivrance" />
                    @error('lieu_delivrance')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- date delivrance, expiration --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="date_delivrance" :value="__('Date delivrance')" />
                    <x-input id="date_delivrance" :value="old('date_delivrance')" class="block mt-1 w-full" type="date"
                        name="date_delivrance" />
                    @error('date_delivrance')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-1">
                    <x-label for="date_expiration" :value="__('Date expiration')" />
                    <x-input id="date_expiration" :value="old('date_expiration')" class="block mt-1 w-full" type="date"
                        name="date_expiration" />
                    @error('date_expiration')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            {{-- envoyer un scan de la carte nationale --}}
            <div class="flex gap-6 justify-start w-full mt-8">
                <div class="rounded p-4 border-dashed border-gray-300 border-2">
                    <label
                        class="flex justify-center flex-col items-center gap-2 text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                        for="scan">
                        <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21 5.5H5C3.93913 5.5 2.92172 5.92143 2.17157 6.67157C1.42143 7.42172 1 8.43913 1 9.5V29.5M1 29.5V33.5C1 34.5609 1.42143 35.5783 2.17157 36.3284C2.92172 37.0786 3.93913 37.5 5 37.5H29C30.0609 37.5 31.0783 37.0786 31.8284 36.3284C32.5786 35.5783 33 34.5609 33 33.5V25.5M1 29.5L10.172 20.328C10.9221 19.5781 11.9393 19.1569 13 19.1569C14.0607 19.1569 15.0779 19.5781 15.828 20.328L21 25.5M33 17.5V25.5M33 25.5L29.828 22.328C29.0779 21.5781 28.0607 21.1569 27 21.1569C25.9393 21.1569 24.9221 21.5781 24.172 22.328L21 25.5M21 25.5L25 29.5M29 5.5H37M33 1.5V9.5M21 13.5H21.02"
                                stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span>Ajouter un scan de votre Carte Nationale</span>
                        <x-input type="file" name="scan" id="scan" class="sr-only" />
                    </label>
                </div>
            </div>

            <h1 class="text-2xl mb-8 w-full">Entrer Les information de votre carte de vote</h1>

            {{-- numero carte de vote --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="numero_inscription" :value="__('Numero Carte Vote')" />
                    <x-input :value="old('numero_inscription    ')" id="numero_inscription" class="block mt-1 w-full" type="text"
                        name="numero_inscription" />
                    @error('numero_inscription')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-1"></div>
            </div>
            {{-- numero de bureau, lieu --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="numero_bureau" :value="__('N° de bureau')" />
                    <x-input id="numero_bureau" :value="old('numero_bureau')" class="block mt-1 w-full" type="number"
                        name="numero_bureau" />
                    @error('numero_bureau')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-1">
                    <x-label for="lieu" :value="__('Lieu  de vote ')" />
                    <x-input id="lieu" :value="old('lieu')" class="block mt-1 w-full" type="text"
                        name="lieu" />
                    @error('lieu')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            {{-- envoyer un scan de carte de vote --}}
            <div class="flex gap-6 justify-start w-full mt-8">
                <div class="rounded p-4 border-dashed border-gray-300 border-2">
                    <label
                        class="flex justify-center flex-col items-center gap-2 text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                        for="scan_vote">
                        <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21 5.5H5C3.93913 5.5 2.92172 5.92143 2.17157 6.67157C1.42143 7.42172 1 8.43913 1 9.5V29.5M1 29.5V33.5C1 34.5609 1.42143 35.5783 2.17157 36.3284C2.92172 37.0786 3.93913 37.5 5 37.5H29C30.0609 37.5 31.0783 37.0786 31.8284 36.3284C32.5786 35.5783 33 34.5609 33 33.5V25.5M1 29.5L10.172 20.328C10.9221 19.5781 11.9393 19.1569 13 19.1569C14.0607 19.1569 15.0779 19.5781 15.828 20.328L21 25.5M33 17.5V25.5M33 25.5L29.828 22.328C29.0779 21.5781 28.0607 21.1569 27 21.1569C25.9393 21.1569 24.9221 21.5781 24.172 22.328L21 25.5M21 25.5L25 29.5M29 5.5H37M33 1.5V9.5M21 13.5H21.02"
                                stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span>Ajouter un scan de votre carte de vote</span>
                        <x-input type="file" name="scan_vote" id="scan_vote" class="sr-only" />
                    </label>
                </div>
            </div>


            {{-- submit --}}
            <div class="flex gap-4 justify-end w-full mt-8">
                <x-tw.back :size="'xl'" href="{{ route('register.step.two') }}">
                    {{ __('Précédent') }}
                </x-tw.back>

                <x-tw.button value="passer" name="submit" id="passer" :size="'xl'">
                    {{ __('Passer') }}
                </x-tw.button>

                <x-tw.button value="save" name="submit" id="save" :size="'xl'">
                    {{ __('Suivant') }}
                </x-tw.button>
            </div>
        </form>
    </div>

</x-guest-layout>

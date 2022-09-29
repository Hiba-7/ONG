<x-guest-layout :padding="'8'">

    {{-- steps & logo --}}
    @include('auth.register.steps')

    {{-- register form --}}
    <div class="bg-white h-full w-full rounded-xl p-3 col-span-6 shadow-xl flex flex-col justify-center items-center">
        <form method="POST" class="w-full p-8 rounded-xl bg-gray-100" action="{{ route('register.step.three.post') }}">
            @csrf

            <h1 class="text-2xl mb-8 w-full">Entrer Les information de votre CV</h1>

            {{-- niveau etude & etat social --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="niveau_etude" :value="__('Niveau d\'étude')" />
                    <x-select class="block mt-1 w-full" :value="old('niveau_etude')" :identity="'niveau_etude'">
                        <option value="">Choisir Votre niveau d'etude</option>
                        @foreach ($niveaux_etudes as $niveau_etude)
                            <option value="{{ $niveau_etude }}">{{ $niveau_etude }}</option>
                        @endforeach
                    </x-select>
                    @error('niveau_etude')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex-1">
                    <x-label for="etat_social" :value="__('Etat Social')" />
                    <x-select class="block mt-1 w-full" :value="old('etat_social')" :identity="'etat_social'">
                        <option value="">Choisir votre Etat Social</option>
                        @foreach ($etats_sociaux as $etat_social)
                            <option value="{{ $etat_social }}">{{ $etat_social }}</option>
                        @endforeach
                    </x-select>
                    @error('etat_social')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- derniere fonction et specialité --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="fonction" :value="__('Derniere Fonction')" />
                    <x-input id="fonction" class="block mt-1 w-full" :value="old('fonction')" type="text" name="fonction" required />
                    @error('fonction')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex-1">
                    <x-label for="spécialité" :value="__('Spécialité')" />
                    <x-input id="spécialité" class="block mt-1 w-full" :value="old('spécialité')" type="text" name="spécialité" required />
                    @error('spécialité')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- submit --}}
            <div class="flex gap-4 justify-end w-full mt-8">
                <x-tw.back :size="'xl'" href="{{ redirect()->route('register.step.two') }}">
                    {{ __('Précédent') }}
                </x-tw.back>
                <x-tw.button :size="'xl'">
                    {{ __('Suivant') }}
                </x-tw.button>
            </div>
        </form>
    </div>

</x-guest-layout>

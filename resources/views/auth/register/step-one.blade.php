<x-guest-layout :padding="'8'">

    {{-- steps & logo --}}
    @include('auth.register.steps')

    {{-- register form --}}
    <div class="bg-white h-full w-full rounded-xl p-3 col-span-6 shadow-xl flex flex-col justify-center items-center">
        <form method="POST" class="w-4/5 p-8 rounded-md bg-gray-100" action="{{ route('register.step.one.post') }}">
            @csrf

            <h1 class="text-2xl font-normal mb-8 w-full">Entrer les information qui apparaitera dans votre profile</h1>

            {{-- email --}}
            <div class="flex gap-6 justify-between w-full mt-8">
                <div class="flex-1">
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>
                <div class="flex-1"></div>
            </div>

            {{-- password & confirm --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="w-full">
                    <x-label for="password" :value="__('Mot de passe')" />
                    <x-input id="password" :value="old('password')" class="block mt-1 w-full" type="password" name="password"
                        required autocomplete="new-password" />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full">
                    <x-label for="password_confirmation" :value="__('Confirmer le Mot de passe')" />
                    <x-input id="password_confirmation" :value="old('password_confirmation')" class="block mt-1 w-full" type="password"
                        required name="password_confirmation" />
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- submit --}}
            <div class="mt-8 float-right">
                <x-tw.button :size="'xl'">
                    {{ __('Suivant') }}
                </x-tw.button>
            </div>
        </form>
    </div>
</x-guest-layout>



{{-- !add profile photo --}}
{{-- <div class="flex gap-2 items-center">
                <span class="h-16 w-16 rounded-full border-4 overflow-hidden bg-gray-100">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
                <label for="profile_photo"
                    class="relative cursor-pointer font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                    <span class="">Ajouter</span>
                    <x-input id="profile_photo" name="profile_photo" type="file" class="sr-only" />
                </label>
            </div> --}}

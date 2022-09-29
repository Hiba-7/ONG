<x-guest-layout>
    <div class="flex w-full overflow-hidden col-span-8 h-full items-center">
        <div class="flex-1 bg-blue-700 h-full lg:flex hidden flex-col justify-center items-center">
            <a href="/">
                <x-application-logo class="w-60" />
            </a>
            <div class="mt-6">
                <p class="text-slate-50 text-xl">Si vous n'avez pas déja un compte <a href="{{ route('register') }}"
                        class="underline hover:text-slate-300">inscrivez-vous</a>
                </p>
            </div>
        </div>

        <div class="flex-1 grid place-items-center">
            <x-auth-card>
                <x-slot name="title"> {{ __('Déja un membre ?') }} </x-slot>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Mot de passe')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>
                    <div class="flex items-center justify-start mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Vous avez oublié votre mot de passe?') }}
                            </a>
                        @endif
                    </div>
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Gardez-moi connecté(e)') }}</span>
                        </label>
                    </div>
                    <div class="w-full mt-4 flex justify-center">
                        <x-button class="bg-blue-700 w-full">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>
</x-guest-layout>

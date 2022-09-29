<nav class="h-12 py-8  shadow-md bg-white flex items-center justify-end lg:justify-between px-16 w-full">

    <h1 class="text-2xl text-gray-900 font-semibold capitalize hidden lg:block">
        {{ $title }}
    </h1>


    <x-dropdown align="right" width="48">
        <x-slot name="trigger">

            {{-- !this button is what triggers the dropdown menu , we'll change it with the user's Porfile Photo --}}
            <button
                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <!-- Authentication -->

            @hasanyrole($needed_roles)
                <x-dropdown-link :href="route('filament.pages.dashboard')">
                    {{ __('Admin') }}
                </x-dropdown-link>
            @endhasanyrole

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>

        </x-slot>
    </x-dropdown>
</nav>

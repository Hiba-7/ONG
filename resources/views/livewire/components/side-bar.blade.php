{{-- ! add the html class <html class="h-full bg-gray-50"> --}}

{{-- ! add the body class <body class="h-full overflow-hidden"> --}}

<div class="h-full flex">
    <!-- Narrow sidebar -->
    <div class="w-20 2xl:w-32 bg-blue-700 overflow-y-auto">
        <div class="w-full py-6 flex h-full flex-col items-center">

            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img class="2xl:h-16 h-10 w-auto" src="{{ URL('/images/icon.png') }}">
                </a>
            </div>

            <div class="flex-1 flex flex-col justify-between mt-6 w-full px-2 space-y-1">
                <!-- Current: "bg-blue-800 text-white", Default: "text-blue-100 hover:bg-blue-800 hover:text-white" -->
                <div>
                    <livewire:components.nav-link :name="__('accueil')" />

                    <livewire:components.nav-link :name="__('formation')" />

                    <livewire:components.nav-link :name="__('instances')" />

                </div>
                <div>
                    <livewire:components.nav-link :name="__('faq')" />

                    <livewire:components.nav-link :name="__('parametres')" />
                </div>
            </div>
        </div>
    </div>

</div>

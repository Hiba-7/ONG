<div x-data="{ activeTab: 'monprofile' }" class="bg-gray-100 h-screen grid p-3 grid-cols-3">
    {{-- make a page so that the logged in user can view his information --}}

    <div class="bg-white flex flex-col justify-start h-[200px] w-[80%] rounded-xl gap-10 col-span-1 border">
            <nav class="" aria-label="menu">

                <ol role="list" class="overflow-hidden">
                    <li>
                        <a x-on:click="activeTab = 'monprofile'"
                            href="#monprofile"
                            class='relative flex items-start group p-3 pl-2 border-b-2'>
                            <span class="h-9 flex items-center" aria-hidden="true">

                                <span
                                x-bind:class="activeTab == 'monprofile' ? 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-blue-600 rounded-full' : 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400'">
                                            <span
                                            x-bind:class="activeTab == 'monprofile' ? 'h-2.5 w-2.5 bg-blue-600 rounded-full' : 'h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300'">
                                            </span>
                                </span>
                            </span>

                            <span class="ml-4 min-w-0 flex flex-col">
                                <span
                                x-bind:class="activeTab == 'monprofile' ? 'text-xs 2xl:text-s font-bold tracking-wide  text-blue-600' : 'text-xs 2xl:text-s font-bold tracking-wide text-gray-500'">
                                 Mon Profile</span>
                                <span class="text-xs 2xl:text-s text-gray-500">Visualiser votre profile et le modifier si vous souhaiter</span>
                            </span>
                        </a>
                    </li>
                        <a x-on:click="activeTab = 'paiment'"
                            href="#paiment"
                            class='relative flex items-start group p-3 pl-2 border-b-2'>
                                <span class="h-9 flex items-center" aria-hidden="true">

                                    <span
                                    x-bind:class="activeTab == 'paiment' ? 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-blue-600 rounded-full' : 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400'">

                                                <span
                                                x-bind:class="activeTab == 'paiment' ? 'h-2.5 w-2.5 bg-blue-600 rounded-full' : 'h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300'">


                                    </span>
                                </span>

                                <span class="ml-4 min-w-0 flex flex-col">
                                    <span
                                    x-bind:class="activeTab == 'paiment' ? 'text-xs 2xl:text-s font-bold tracking-wide  text-blue-600' : 'text-xs 2xl:text-s font-bold tracking-wide text-gray-500'">
                                        Paiment</span>
                                    <span class="text-xs 2xl:text-s text-gray-500">Les details de votre paiement</span>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a x-on:click="activeTab = 'motdepasse'"
                            href="#motdepasse"
                            class='relative flex items-start group p-3 pl-2'>
                            <span class="h-9 flex items-center" aria-hidden="true">

                                <span
                                x-bind:class="activeTab == 'motdepasse' ? 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-blue-600 rounded-full' : 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400'">

                                            <span
                                            x-bind:class="activeTab == 'motdepasse' ? 'h-2.5 w-2.5 bg-blue-600 rounded-full' : 'h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300'">


                                </span>
                            </span>

                            <span class="ml-4 min-w-0 flex flex-col">
                                <span
                                x-bind:class="activeTab == 'motdepasse' ? 'text-xs 2xl:text-s font-bold tracking-wide  text-blue-600' : 'text-xs 2xl:text-s font-bold tracking-wide text-gray-500'">
                                    Mot de Passe</span>
                                <span class="text-xs 2xl:text-s text-gray-500">Réinitialiser votre mot de passe</span>
                            </span>
                        </a>
                    </li>

                </ol>
            </nav>

        </div>
    <div class="col-span-2" x-show="activeTab === 'monprofile'" x-cloak>
        <livewire:components.profile />
    </div>
    <div class="col-span-2" x-show="activeTab === 'paiment'" x-cloak>
        <livewire:components.profile-paiment />
    </div>
    <div class="col-span-2" x-show="activeTab === 'motdepasse'" x-cloak>
        <livewire:components.profile-pass />
    </div>

</div>

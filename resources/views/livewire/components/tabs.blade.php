<div x-data="{ activeTab: 'MonProgres' }" x-init="activeTab = window.location.hash ? window.location.hash.replace('#', '') : 'MonProgres'" class="h-full w-full">
    <div class="flex flex-col gap-0 items-center">
        <nav class="flex items-center  justify-between h-16 px-4 mx-auto w-full">

            <ul {{-- change the border width in tailwind, how to change classes in alpinejs --}}
                class="items-center  justify-center hidden text-sm font-medium space-x-8 lg:flex lg:flex-1 lg:w-0">
                <li>
                    <a x-on:click="activeTab = 'MonProgres'"
                        x-bind:class=" activeTab === 'MonProgres' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#MonProgres">
                        Mon Progres
                    </a>
                </li>

                <li>
                    <a x-on:click="activeTab = 'Niveau1'"
                        x-bind:class=" activeTab === 'Niveau1' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#Niveau1">
                        Niveau 1
                    </a>
                </li>

                <li>
                    <a x-on:click="activeTab = 'Niveau2'"
                        x-bind:class=" activeTab === 'Niveau2' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#Niveau2">
                        Niveau 2
                    </a>
                </li>
                <li>
                    <a x-on:click="activeTab = 'Niveau3'"
                        x-bind:class=" activeTab === 'Niveau3' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#Niveau3">
                        Niveau 3
                    </a>
                </li>
                <li>
                    <a x-on:click="activeTab = 'Niveau4'"
                        x-bind:class=" activeTab === 'Niveau4' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#Niveau4">
                        Niveau 4
                    </a>
                </li>
                <li>
                    <a x-on:click="activeTab = 'Niveau5'"
                        x-bind:class=" activeTab === 'Niveau5' ? 'text-blue-700 font-bold' : 'text-gray-700'"
                        href="#Niveau5">
                        Niveau 5
                    </a>
                </li>
            </ul>
        </nav>
        <hr class="w-4/6 border-gray-300">
    </div>

    <div class="p-8 h-full  text-gray-700 rounded-lg">

        <div x-show="activeTab === 'MonProgres'">
            <livewire:components.tabs.mon-progres :formations="$formations" />
        </div>
        <div x-show="activeTab === 'Niveau1'">
            <livewire:components.tabs.niveau :formation="$formations[0]" />
        </div>
        <div x-show="activeTab === 'Niveau2'">
            <livewire:components.tabs.niveau :formation="$formations[1]" />
        </div>
        <div x-show="activeTab === 'Niveau3'">
            <livewire:components.tabs.niveau :formation="$formations[2]" />
        </div>
        <div x-show="activeTab === 'Niveau4'">
            <livewire:components.tabs.niveau :formation="$formations[3]" />
        </div>
        <div x-show="activeTab === 'Niveau5'">
            <livewire:components.tabs.niveau :formation="$formations[4]" />
        </div>
    </div>
</div>

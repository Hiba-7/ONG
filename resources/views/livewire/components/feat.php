{{-- The best athlete wants his opponent at his best. --}}
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="pt-100 bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="grid grid-cols-4 px-4 py-5 sm:px-6">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Vos informations personnelles.</p>
        </div>
        <div class="px-3 col-start-3 col-span-2 grid grid-cols-2 border-l border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Photo Profile</h3>
            <div class="grid grid-cols-4 py-4 gap-10">
                <div x-on:click="" x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false"
                    class="relative col-start-2">
                    <div x-show="hover"
                        class="absolute w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <p class="text-center">{{ __('Change Picture') }}</p>

                    </div>
                    <x-rounded-image id="upload_pic" x-bind:class=" hover == true ? 'opacity-25 col-start-2' : ''"
                        :src="URL('/images/profile-picture.jpeg')" />

                    <input class="cursor-pointer opacity-0 rounded-sm absolute left-0 w-full top-0 h-full"
                        id="profile_pic" type='file' accept="image/*" />
                </div>

            </div>
            <!-- <x-rounded-image class="col-start-2" :src="URL('/images/profile-picture.jpeg')" /> -->
        </div>



    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            {{-- <div class=" grid grid-cols-4 py-4 gap-10">


            </div> --}}
            <x-profile-item :disabled="true" :label="'Nom'" :content="$user->nom" />
            <x-profile-item :label="'Prénom'" :content="$user->prénom" />
            <x-profile-item :label="'Numéro de téléphone'" :content="$user->téléphone" />
            <x-profile-item :label="'Adresse email'" :content="$user->email" />
            <x-profile-item :label="'Cotisation total'" :content="__('Cotisation à implementer')" />
            <x-profile-item :label="'Carte nationale'" :content="$user->carte->numero" />
        </dl>
    </div>
</div>
<script>
profile_pic.onchange = evt => {
    const [file] = profile_pic.files
    if (file) {
        upload_pic.src = URL.createObjectURL(file)
    }
}
</script>
{{-- <style>
            img {
                list-style: none;
                width: 200px;
                aspect-ratio: auto 200 / 200;
                height: 200px;
                box-sizing: border-box;
                border-style: none;
                display: inline-block;
                overflow: hidden;
                line-height: 1;
                vertical-align: middle;
                background-color: var(--color-avatar-bg);
                flex-
shrink: 0;
                box-shadow: 0 0 0 1px var(--color-avatar-border);
                border-radius: 50% !important;
            }
        </style> --}}
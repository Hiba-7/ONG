{{-- The best athlete wants his opponent at his best. --}}
<!-- This example requires Tailwind CSS v2.0+ -->
@if (!empty($errors->all()))
    <div x-data="{ display: false, }" class="pt-100 bg-white shadow overflow-hidden sm:rounded-lg">
    @else
        <div x-data="{ display: true, }" class="pt-100 bg-white shadow overflow-hidden sm:rounded-lg">
@endif

<form method="POST" action="{{ route('profile.submit') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-4 px-4 py-5 sm:px-6">
        <div class="col-span-2">
            <h3 class="inline-block text-lg leading-6 font-medium text-gray-900">Profile</h3>
            <x-tw.badge :color="'green'">
                {{ collect(explode('_', $user->etat_profile_courant))->map(function ($value, $key) {
                        return ucwords($value);
                    })->implode(' ') }}
            </x-tw.badge>

            <p class="mt-1 max-w-2xl text-sm text-gray-500">Vos informations personnelles.
            </p>

        </div>
        <div class="px-3 col-start-3 col-span-2 grid grid-cols-2 border-l border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Photo Profile</h3>
            @error('photo_profile')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div x-data="{ hover: false }" @mouseover="hover=true" @mouseout="hover = false;"
                class="relative col-start-2">
                <div x-show="hover && !display"
                    class="absolute w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <p class="text-center">{{ __('Change Picture') }}</p>

                </div>
                <x-rounded-image
                    style="  border: 2px solid white; -moz-box-shadow: 0 0 3px rgb(41, 39, 39);
                    -webkit-box-shadow: 0 0 3px rgb(41, 39, 39);
                    box-shadow: 0 0 3px rgb(41, 39, 39);"
                    id="profile_pic" x-bind:class=" hover && !display == true ? 'opacity-25 col-start-2' : ''"
                    :src="URL('/images/avatar/' . $user->photo_profile)" />
                <input x-bind:disabled="display" name="photo_profile"
                    x-bind:class="display ? 'pointer-events-none' : 'cursor-pointer'"
                    class="opacity-0 rounded-sm absolute left-0 w-full top-0 h-full" id="upload_pic" type='file'
                    accept=".png, .jpg, .jpeg, .svg" />

            </div>

        </div>



    </div>
    <div x-show="display == true" x-cloak class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <x-profile-item :label="'Nom'" :content="$user->nom" />
            <x-profile-item :label="'Prénom'" :content="$user->prénom" />
            <x-profile-item :label="'Numéro de téléphone'" :content="$user->téléphone" />
            <x-profile-item :label="'Adresse email'" :content="$user->email" />
            <x-profile-item :label="'Adresse'" :content="$user->adresse" />
            <x-profile-item :label="'Niveau etude'" :content="$user->niveau_etude" />
            <x-profile-item :label="'Etat social'" :content="$user->etat_social" />
            <x-profile-item :label="'Adresse email'" :content="$user->email" />
            <x-profile-item :label="'Cotisation total'":content="__('Cotisation à implementer')" />

        </dl>
    </div>
    <div x-show="display == false" x-cloak class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <x-profile-item :input="true" :name="'nom'" :label="'Nom'" :content="$user->nom" />
            <x-profile-item :input="true" :name="'prénom'" :label="'Prénom'" :content="$user->prénom" />
            <x-profile-item :input="true" :name="'téléphone'" :label="'Numéro de téléphone'" :content="$user->téléphone" />
            <x-profile-item :input="true" :name="'email'" :label="'Adresse email'" :content="$user->email" />
            <x-profile-item :input="true" :name="'adresse'" :label="'Adresse'" :content="$user->adresse" />
            <x-profile-item :input="true" :name="'niveau_etude'" :label="'Niveau etude'" :content="$user->niveau_etude" />
            <x-profile-item :input="true" :name="'etat_social'" :label="'Etat social'" :content="$user->etat_social" />
            <x-profile-item :input="true" :label="'Cotisation total'" :content="__('Cotisation à implementer')" />
        </dl>
    </div>
    <div class="border-t p-10 pb-3 flex justify-end">
        <x-tw.button id="revert" x-on:click="display=!display;RevertText(display)" type="button">
            Modifier
        </x-tw.button>
        <x-tw.button id="sauvegarder" disabled class="bg-gray-600 hover:bg-gray-600 ml-3">
            Sauvegarder
        </x-tw.button>
    </div>
    @if (!empty($errors->all()))
        <script>
            RevertText(false)
        </script>
    @endif
</form>
</div>

<script>
    function RevertText(display) {
        if (display == true) {
            revert.innerText = "Modifier";
            sauvegarder.setAttribute('type',
                '');
            sauvegarder.classList.add('bg-gray-600',
                'hover:bg-gray-600');
            sauvegarder.disabled = true;
        } else {
            revert.innerText = "annuler";
            sauvegarder.setAttribute('type',
                'submit');
            sauvegarder.classList.remove('bg-gray-600', 'hover:bg-gray-600');
            sauvegarder.disabled = false;
        }

    }
    @if (!empty($errors->all()))
        RevertText(false)
    @endif
    upload_pic.onchange = evt => {
        const [file] = upload_pic.files
        if (file) {
            profile_pic.src = URL.createObjectURL(file)

        }
    }
</script>

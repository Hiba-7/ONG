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
                    :src="URL(
                        '/images/avatars/' . str($user->photo_profile ? $user->photo_profile : 'default.jpg'),
                    )" />
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
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Information de carte d'identité</h3>
            </div>

            <div class="px-4 py-5 sm:px-6 grid grid-cols-3">

                <div class="col-span-2">
                    <x-profile-item :label="'Numero de la carte'" :content="$carte->numero" />
                    <x-profile-item :label="'Date de delivrance'" :content="$carte->date_delivrance" />
                    <x-profile-item :label="'Date de expiration'" :content="$carte->date_expiration" />
                </div>
                <div class="flex items-center">
                    <img class=""
                        src="{{ $carte->scan ? URL('/images/id_cards/' . $carte->scan) : URL('/images/placeholder.jpg') }}"
                        alt="" class="w-[auto] max-h-[150px]">
                </div>
            </div>

            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Information de carte d'vote</h3>
            </div>

            <div class="px-4 py-5 sm:px-6 grid grid-cols-3">

                <div class="col-span-2">
                    <x-profile-item :label="'Numero de la carte'" :content="$vote_carte->numero_inscription" />
                    <x-profile-item :label="'Lieu de vote'" :content="$vote_carte->lieu" />
                    <x-profile-item :label="'Numero de bureau'" :content="$vote_carte->numero_bureau" />
                </div>
                <div class="flex items-center">
                    <img class=""
                        src="{{ $vote_carte->scan_vote ? URL('/images/vote_cards/' . $vote_carte->scan_vote) : URL('/images/placeholder.jpg') }}"
                        alt="" class="w-[auto] max-h-[150px]">
                </div>
            </div>
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
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Information de carte d'identité</h3>
            </div>

            <div class="px-4 py-5 sm:px-6 grid grid-cols-3">

                <div class="col-span-2">
                    <x-profile-item :input="true" :name="'numero'" :label="'Numero de la carte'" :content="$carte->numero" />
                    <x-profile-item :type="'date'" :input="true" :name="'date_delivrance'" :label="'Date de delivrance'"
                        :content="$carte->date_delivrance" />
                    <x-profile-item :type="'date'" :input="true" :name="'date_expiration'" :label="'Date de expiration'"
                        :content="$carte->date_expiration" />
                </div>
                <div class="flex items-center">
                    <div x-data="{ hover: false }" @mouseover="hover=true" @mouseout="hover = false;"
                        class="relative col-start-2">
                        <div x-show="hover && !display"
                            class="absolute w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <p class="text-center">{{ __('Change Picture') }}</p>

                        </div>
                        <img class="w-[auto] max-h-[150px]" id="carte_scan"
                            x-bind:class=" hover && !display == true ? 'opacity-25 col-start-2' : ''"
                            src="{{ $carte->scan ? URL('/images/id_cards/' . $carte->scan) : URL('/images/placeholder.jpg') }}" />
                        <input x-bind:disabled="display" name="scan"
                            x-bind:class="display ? 'pointer-events-none' : 'cursor-pointer'"
                            class="opacity-0 rounded-sm absolute left-0 w-full top-0 h-full" id="carte_upload"
                            type='file' accept=".png, .jpg, .jpeg, .svg" />

                    </div>
                    <img class="" alt="">
                </div>
            </div>

            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Information de carte de vote</h3>
            </div>
            {{-- vote carde form --}}
            <div class="px-4 py-5 sm:px-6 grid grid-cols-3">

                <div class="col-span-2">
                    <x-profile-item input="true" :name="'numero_inscription'" :label="'Numero de la carte'" :content="$vote_carte->numero_inscription" />
                    <x-profile-item input="true" :type="'number'" :name="'lieu'" :label="'Lieu de vote'"
                        :content="$vote_carte->lieu" />
                    <x-profile-item input="true" :name="'numero_bureau'" :label="'Numero de bureau'" :content="$vote_carte->numero_bureau" />
                </div>
                <div class="flex items-center">
                    <div x-data="{ hover: false }" @mouseover="hover=true" @mouseout="hover = false;"
                        class="relative col-start-2">
                        <div x-show="hover && !display"
                            class="absolute w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <p class="text-center">{{ __('Change Picture') }}</p>

                        </div>
                        <img class="w-[auto] max-h-[150px]" id="scan_vote"
                            x-bind:class=" hover && !display == true ? 'opacity-25 col-start-2' : ''"
                            src="{{ $vote_carte->scan_vote ? URL('/images/vote_cards/' . $vote_carte->scan_vote) : URL('/images/placeholder.jpg') }}" />
                        <input x-bind:disabled="display" name="scan_vote"
                            x-bind:class="display ? 'pointer-events-none' : 'cursor-pointer'"
                            class="opacity-0 rounded-sm absolute left-0 w-full top-0 h-full" id="vote_upload"
                            type='file' accept=".png, .jpg, .jpeg, .svg" />

                    </div>
                    <img class="" alt="">
                </div>
            </div>

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
    carte_upload.onchange = evt => {
        const [scan] = carte_upload.files
        if (scan) {
            carte_scan.src = URL.createObjectURL(scan)

        }
    }
    vote_upload.onchange = evt => {
        const [scan] = vote_upload.files
        if (scan) {
            vote_scan.src = URL.createObjectURL(scan)

        }
    }
</script>

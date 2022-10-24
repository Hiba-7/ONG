<x-guest-layout :padding="'8'">

    {{-- steps & logo --}}
    @include('auth.register.steps')

    {{-- register form --}}
    <div class="bg-white h-full w-full rounded-xl p-3 col-span-6 shadow-xl flex flex-col justify-center items-center">

        <form method="POST" class="w-4/5 p-8 rounded-md bg-gray-100" action="{{ route('register.step.two.post') }}">
            @csrf

            <h1 class="text-2xl mb-8 w-full">Entrer votre informations Personèlle</h1>

            {{-- civilité et date naissance --}}
            <div class="flex gap-6 justify-between w-full mt-8">
                <div class="flex-1">
                    <x-label for="civilité" :value="__('Civilité')" />
                    <x-select required :value="old('civilité')" class="block mt-1 w-full" :identity="'civilité'">
                        <option value="Mr">Mr.</option>
                        <option value="Mme">Mme.</option>
                    </x-select>

                    @error('civilité')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex-1">
                    <x-label for="date_naissance" :value="__('Date de naissance')" />
                    <x-input :value="old('date_naissance')" id="date_naissance" class="w-full" type="date" name="date_naissance"
                        required />

                    @error('date_naissance')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- nom et prenom --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="nom" :value="__('Nom')" />
                    <x-input :value="old('nom')" id="nom" class="block mt-1 w-full" type="text" name="nom"
                        required />

                    @error('nom')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>

                <div class="flex-1">
                    <x-label for="prénom" :value="__('Prénom')" />
                    <x-input :value="old('prénom')" id="prénom" class="block mt-1 w-full" type="text" name="prénom"
                        required />

                    @error('prénom')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            {{-- adresse et adresse secondaire --}}
            <div class="flex gap-6 justify-center w-full mt-8">
                <div class="flex-1">
                    <x-label for="adresse" :value="__('Adresse')" />
                    <x-input :value="old('adresse')" id="adresse" class="block mt-1 w-full" type="text" name="adresse"
                        required />

                    @error('adresse')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>

                <div class="flex-1">
                    <x-label for="adresse_secondaire" :value="__('Adresse secondaire')" />
                    <x-input :value="old('adresse_secondaire')" id="adresse_secondaire" class="block mt-1 w-full" type="text"
                        name="adresse_secondaire" />

                    @error('adresse_secondaire')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 mt-8 w-full place-items-center" x-data="{ ...getPays(), ...getWilayas(), ...getCommunes(), selectedPays: null, selectedWilaya: null }"
                x-init="fetchAllPays">

                {{-- pays --}}
                <div class="w-full">
                    <x-label for="pays" :value="__('Pays')" />
                    <x-select :value="old('pays_id')" x-model="selectedPays" required class="block mt-1 w-full"
                        :identity="__('pays_id')">
                        <option value="">Selectioner votre Pays</option>
                        <template x-for="p in pays">
                            <option x-bind:value="p.id" x-text="p.nom">
                            </option>
                        </template>
                    </x-select>
                    @error('pays_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- wilayas --}}
                <template x-if="selectedPays == 4">
                    <div class="w-full" x-init="fetchAllWilayas">
                        <x-label for="wilaya_id" :value="__('Wilaya')" />
                        <x-select :value="old('wilaya_id')" required class="block mt-1 w-full" :identity="'wilaya_id'"
                            x-model="selectedWilaya">
                            <option value="">Selectioner votre wilaya</option>
                            <template x-for="wilaya in wilayas">
                                <option x-bind:value="wilaya.id" x-text="wilaya.id + ' . ' + wilaya.nom">
                                </option>
                            </template>
                        </x-select>
                        @error('wilaya_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </template>

                {{-- communes --}}
                <template x-if="selectedPays == 4">
                    <div class="w-full" x-data="getCommunes(selectedWilaya)"
                        x-effect="() => fetchCommunesByWilayaId(selectedWilaya)">
                        <x-label for="commune_id" :value="__('Commune')" />
                        <x-select :value="old('commune_id')" required class="block mt-1 w-full" :identity="'commune_id'">
                            <option value="">Selectioner votre commune</option>
                            <template x-for="commune in communes">
                                <option x-bind:value="commune.id" x-text="commune.nom"></option>
                            </template>
                        </x-select>
                        @error('commune_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </template>

                {{-- departement --}}
                <template x-if="selectedPays != 4">
                    <div class="w-full">
                        <x-label for="departement" :value="__('Département')" />
                        <x-input required :value="old('nom_departement')" id="departement" class="block mt-1 w-full" type="text"
                            name="nom_departement" placeholder="Département" />
                        @error('nom_departement')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </template>

                {{-- phone number --}}
                <div class="w-full">
                    <x-label class="mb-1" for="téléphone" :value="__('Numéro de téléphone')" />
                    <x-input :value="old('téléphone')" type="tel" class="block w-full" name="téléphone" id="phone" />
                    @error('téléphone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

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
                    <x-input id="fonction" class="block mt-1 w-full" :value="old('fonction')" type="text"
                        name="fonction" required />
                    @error('fonction')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex-1">
                    <x-label for="spécialité" :value="__('Spécialité')" />
                    <x-input id="spécialité" class="block mt-1 w-full" :value="old('spécialité')" type="text"
                        name="spécialité" required />
                    @error('spécialité')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            {{-- submit --}}
            <div class="flex gap-4 justify-end w-full mt-8">
                <x-tw.back :size="'xl'" href="{{ redirect()->route('register.step.one') }}">
                    {{ __('Précédent') }}
                </x-tw.back>
                <x-tw.button :size="'xl'">
                    {{ __('Suivant') }}
                </x-tw.button>
            </div>
        </form>
    </div>

    <script>
        function getPays() {
            return {
                pays: [],
                fetchAllPays() {
                    axios.get('/api/pays')
                        .then(res => this.pays = res.data)
                }
            }
        }

        function getWilayas() {
            return {
                wilayas: [],
                fetchAllWilayas() {
                    axios.get('/api/wilayas')
                        .then(response => this.wilayas = response.data)
                }
            }
        }

        function getCommunes(wilaya_id) {
            return {
                communes: [],
                fetchCommunesByWilayaId(wilaya_id) {
                    axios.get(`/api/wilayas/${wilaya_id}/communes`)
                        .then(response => this.communes = response.data)
                }
            }
        }
    </script>

</x-guest-layout>

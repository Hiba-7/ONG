<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use App\Models\Carte;
use App\Models\VoteCarte;
use App\Models\Pays;

use Illuminate\Http\Request;
use File;
use Illuminate\Validation\Rules\Enum;
use App\Enums\UserEtatSocialEnum;
use App\Enums\UserNiveauEtudeEnum;
use Filament\Notifications\Notification;
use Livewire\Component;

class Profile extends Component
{
    public $is_incomplete;

    public function render()
    {
        $etats_sociaux = UserEtatSocialEnum::getValues();
        $niveaux_etudes = UserNiveauEtudeEnum::getValues();
        $user = User::where('id', auth()->id())->with('carte', 'vote_carte')->get()[0];
        $carte = $user->carte;
        $vote_carte = $user->vote_carte;
        return view('livewire.components.profile', compact('user', 'carte', 'vote_carte', 'etats_sociaux', 'niveaux_etudes'));
    }
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'photo_profile' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060'],
            'email' => ['nullable', 'email', 'unique:users', 'max:255', 'unique:users'],
            'adresse' => ['nullable', 'string'],
            'adresse_secondaire' => ['nullable', 'string'],
            'téléphone' => ['nullable', 'string', 'max:255'],
            'pays_id' => ['nullable', 'exists:pays,id'],
            'niveau_etude' => ['nullable', new Enum(UserNiveauEtudeEnum::class)],
            'etat_social' => ['nullable', new Enum(UserEtatSocialEnum::class)],
            'spécialité' => ['nullable', 'string', 'max:255'],
            'fonction' => ['nullable', 'string', 'max:255'],

            'numero' => ['nullable', 'numeric', 'maxdigits:20'],
            'lieu_delivrance' => ['nullable', 'string'],
            'date_delivrance' => ['nullable', 'date'],
            'date_expiration' => ['nullable', 'date', 'after:date_delivrance', 'after:today'],
            'scan' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060'],

            'numero_inscription' => ['nullable', 'numeric'],
            'lieu' => ['nullable', 'string'],
            'numero_bureau' => ['nullable', 'numeric'],
            'scan_vote' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060']
        ]);
        if ($validatedData['pays_id'] == 4) {
            $validatedData = array_merge($validatedData, $request->validate([
                'wilaya_id' => ['nullable', 'required_with:commune_id', 'lt:1542', 'exists:wilayas,id'],
                'commune_id' => ['nullable', 'required_with:wilaya_id', 'lt:1542', 'exists:communes,id']
            ]));
        } else {
            $validatedData = array_merge($validatedData, $request->validate([
                'nom_departement' => ['nullable', 'string']
            ]));
        }


        $user = auth()->user();
        $carte = Carte::find(auth()->user()->carte)->first();
        $vote_carte = VoteCarte::find(auth()->user()->vote_carte)->first();


        // setting unchaged user values to null
        foreach ($validatedData as $key => $value) {
            if ($validatedData[$key] != null && $validatedData[$key] == $user->$key) {
                $validatedData[$key] = null;
            }
        }




        // extracting cartes data and setting unchanged values to null
        $carte_data = [
            'numero' => $validatedData['numero'],
            'lieu_delivrance' => $validatedData['lieu_delivrance'],
            'date_delivrance' => $validatedData['date_delivrance'],
            'date_expiration' => $validatedData['date_expiration'],
        ];
        foreach ($carte_data as $key => $value) {
            if ($carte_data[$key] != null && $carte_data[$key] == $carte->$key) {
                $carte_data[$key] = null;
            }
        }

        $vote_carte_data = [
            'numero_inscription' => $validatedData['numero_inscription'],
            'lieu' => $validatedData['lieu'],
            'numero_bureau' => $validatedData['numero_bureau'],
        ];
        foreach ($vote_carte_data as $key => $value) {
            if ($vote_carte_data[$key] != null && $vote_carte_data[$key] == $vote_carte->$key) {
                $vote_carte_data[$key] = null;
            }
        }
        // removing cartes data from ValidatedData
        $validatedData = array_diff_key($validatedData, array_flip([
            'numero',
            'lieu_delivrance',
            'date_delivrance',
            'date_expiration',
            'numero_inscription',
            'lieu',
            'numero_bureau',
        ]));

        // dropping null values and keys from the arrays
        $filteredData = array_filter($validatedData, 'strlen');
        $carte_data = array_filter($carte_data, 'strlen');
        $vote_carte_data = array_filter($vote_carte_data, 'strlen');

        // raising an error message if the values haven't changed
        if (empty($filteredData) && empty($carte_data) && empty($vote_carte_data) && !isset($validatedData['scan']) && !isset($validatedData['scan_vote'])) {
            Notification::make()
                ->title(__('No Changes Detected'))
                ->danger()
                ->send();

            $error = \Illuminate\Validation\ValidationException::withMessages([
                'form' => ['Form is empty'],
            ]);
            throw $error;
        }


        // saving the profile picture
        if (isset($filteredData['photo_profile'])) {
            $file = $request->file('photo_profile');
            $old_photo = '/images/avatars/' . $user->photo_profile;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/avatars'), $filename);
            if (File::exists(public_path($old_photo)) && $user->photo_profile != "default.jpg") {
                File::delete(public_path($old_photo));
            }
            $filteredData['photo_profile'] = $filename;
        }

        // saving the carte national scan
        if (isset($validatedData['scan'])) {
            $file = $request->file('scan');
            $old_scan = '/images/scans/' . $carte->scan;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/id_cards'), $filename);
            if (File::exists(public_path($old_scan))) {
                File::delete(public_path($old_scan));
            }
            $carte_data['scan'] = $filename;
        }

        // saving the vote scan
        if (isset($validatedData['scan_vote'])) {
            $file = $request->file('scan_vote');
            $old_scan = '/images/vote_cards/' . $vote_carte->scan_vote;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/vote_cards'), $filename);
            if (File::exists(public_path($old_scan))) {
                File::delete(public_path($old_scan));
            }
            $vote_carte_data['scan_vote'] = $filename;
        }

        $user->update($filteredData);

        if (!empty($carte_data)) {
            $user->carte->update($carte_data);
        }

        if (!empty($vote_carte_data)) {
            $user->vote_carte->update($vote_carte_data);
        }

        Notification::make()
            ->title(__('Profile Updated successfully'))
            ->success()
            ->send();

        return redirect()->route('parametres');
    }
}
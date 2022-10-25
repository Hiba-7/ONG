<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserCiviliteEnum;
use App\Http\Controllers\Controller;

use App\Models\Pays;
use App\Models\User;
use App\Models\Carte;
use App\Models\VoteCarte;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;
use App\Enums\UserEtatSocialEnum;
use App\Enums\UserNiveauEtudeEnum;
use File;



//! où peut-on insérer l'attribut booléen fondateur
class RegisteredUserController extends Controller
{
    public function createStepOne()
    {
        $states = [];
        return view('auth.register.step-one', compact('states'));
    }

    public function storeStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User($validatedData);

        $request->session()->put('user', $user);
        $request->session()->put('steps.step-one', true);

        return redirect()->route('register.step.two');
    }


    //?
    //? step 2
    //?
    public function createStepTwo()
    {
        $etats_sociaux = UserEtatSocialEnum::getValues();
        $niveaux_etudes = UserNiveauEtudeEnum::getValues();
        $states = ["state1" => "completed", "state2" => "current"];
        return view('auth.register.step-two', compact('states', 'etats_sociaux', 'niveaux_etudes'));
    }

    public function storeStepTwo(Request $request)
    {

        $validatedData = $request->validate([
            'civilité' => [new Enum(UserCiviliteEnum::class)],
            'nom' => ['required', 'string', 'max:255'],
            'prénom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'téléphone' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string'],
            'pays_id' => ['required', 'exists:pays,id'],
            'niveau_etude' => [new Enum(UserNiveauEtudeEnum::class)],
            'etat_social' => [new Enum(UserEtatSocialEnum::class)],
            'spécialité' => ['required', 'string', 'max:255'],
            'fonction' => ['required', 'string', 'max:255'],
        ]);
        if ($validatedData['pays_id'] == 4) {
            $validatedData = array_merge($validatedData, $request->validate([
                'commune_id' => ['required', 'lt:1542', 'exists:communes,id']
            ]));
        } else {
            $validatedData = array_merge($validatedData, $request->validate([
                'nom_departement' => ['string']
            ]));
        }

        $user = $request->session()->get('user');
        $user->fill($validatedData);
        $request->session()->put('user', $user);
        $request->session()->put('steps.step-two', true);

        return redirect()->route('register.step.three');
    }


    //?
    //? step 3
    //?
    // public function createStepThree()
    // {
    //     $etats_sociaux = UserEtatSocialEnum::getValues();
    //     $niveaux_etudes = UserNiveauEtudeEnum::getValues();
    //     $states = ["state1" => "completed", "state2" => "completed", "state3" => "current"];
    //     return view('auth.register.step-three', compact('states', 'etats_sociaux', 'niveaux_etudes'));
    // }



    // public function storeStepThree(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'niveau_etude' => [new Enum(UserNiveauEtudeEnum::class)],
    //         'etat_social' => [new Enum(UserEtatSocialEnum::class)],
    //         'spécialité' => ['required', 'string', 'max:255'],
    //         'fonction' => ['required', 'string', 'max:255'],
    //     ]);

    //     $user = $request->session()->get('user');
    //     $user->fill($validatedData);

    //     $request->session()->put('user', $user);
    //     $request->session()->put('steps.step-three', true);

    //     return redirect()->route('register.step.four');
    // }

    //?
    //? step 4
    //?

    public function createStepThree()
    {

        $states = ["state1" => "completed", "state2" => "completed", "state3" => "current"];
        return view('auth.register.step-three', compact('states'));
    }


    public function storeStepThree(Request $request)
    {
        if ($request['submit'] == 'save') {

            $validatedData = $request->validate([
                'numero' => ['nullable', 'required_with:date_delivrance,lieu_delivrance,date_expiration', 'integer'],
                'date_delivrance' => ['nullable', 'required_with:numero,lieu_delivrance,date_expiration', 'date'],
                'lieu_delivrance' => ['nullable', 'required_with:date_delivrance,numero,date_expiration', 'string'],
                'date_expiration' => ['nullable', 'required_with:date_delivrance,lieu_delivrance,numero', 'date', 'after:date_delivrance', 'after:today'],
                'scan' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060'],

                'numero_inscription' => ['nullable', 'integer'],
                'numero_bureau' => ['nullable', 'integer'],
                'lieu' => ['nullable', 'string'],
                'scan_vote' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060'],
            ]);
        } else {
            $validatedData = $request->all();
            foreach ($validatedData as $key => $value) {
                $validatedData[$key] = null;
            }
        }




        $user = $request->session()->get("user");
        $user->save();

        // UserObeserver will attach the latest simple cotisation to the user
        if ($request->file('scan')) {
            $file = $request->file('scan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/id_cards'), $filename);
            $validatedData['scan'] = $filename;
        }

        if ($request->file('scan_vote')) {
            $file = $request->file('scan_vote');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/vote_cards'), $filename);
            $validatedData['scan_vote'] = $filename;
        }

        $carte = new Carte($validatedData);
        $user->carte()->save($carte);

        $vote_carte = new VoteCarte($validatedData);
        $user->vote_carte()->save($vote_carte);




        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
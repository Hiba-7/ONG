<?php

namespace App\Http\Livewire\Pages;

use App\Models\Formation as FormationModel;
use Livewire\Component;

class Formation extends Component
{


    public function render()
    {
        // for the tabs page
        // in the progress tab:
        // we want to get all the formations that a user is subscribed to
        // then filter them by the ones that the user has alreadey completed
        // based on the formation_user pivot table's certifié column.
        // in the niveaux tabs:
        // we want to display all the modules that are in each "niveau"
        $formations = FormationModel::orderBy('niveau')->get();


        return view('livewire.pages.adherent.formation', [
            'formations' => $formations
        ]);
    }
}

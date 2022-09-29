<?php

namespace App\Http\Livewire\Pages;

use App\Models\Instance;
use App\Models\Poste;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Adresse extends Component
{

    public function render()
    {
        return view('livewire.pages.adherent.adresse', ['instances' => Instance::where('est_virtuelle', '=', 1)->with('users', 'postes')->paginate(10)]);
    }
}

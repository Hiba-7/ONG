<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class Accueil extends Component
{
    public $user;
    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.pages.adherent.accueil', ['user' => $this->user]);
    }
}

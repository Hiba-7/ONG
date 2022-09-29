<?php

namespace App\Http\Livewire\Components;

use App\Models\Instance;
use Livewire\Component;

class InstanceCard extends Component
{
    // instance card est un composant qui affiche les informations d'une instance
    public $instance_nom = '', $instance_id, $postes, $nbre_adherents = 0;
    public function mount($instance)
    {
        $this->instance_nom = $instance->nom;
        $this->instance_id = $instance->id;
        $this->postes = $instance->postes;
        $this->nbre_adherents = $instance->users->count();
    }
    public function render()
    {
        return view('livewire.components.instance-card');
    }
}

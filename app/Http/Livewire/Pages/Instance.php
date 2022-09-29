<?php

namespace App\Http\Livewire\Pages;

use App\Models\Instance as ModelsInstance;
use App\Models\Poste;
use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\Route;
use Livewire\Component;

class Instance extends Component
{
    // une page dédiée à une instance afin d'afficher les postes de cette instance
    public $instance_nom;
    public function mount($instance_id, $instance_nom)
    {
        $this->instance_id = $instance_id;
        $this->instance_nom = $instance_nom;
    }
    public function render()
    {
        return view('livewire.pages.adherent.instance', ['users' => ModelsInstance::find($this->instance_id)->users()->with("postes", "pays", "wilaya")->paginate(9)]);
    }
}

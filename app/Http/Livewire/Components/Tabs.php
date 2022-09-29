<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Tabs extends Component
{
    public $formations;
    public function mount($formations)
    {
        $this->formations = $formations;
    }
    public function render()
    {
        return view('livewire.components.tabs');
    }
}

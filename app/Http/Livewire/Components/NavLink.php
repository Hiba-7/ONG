<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavLink extends Component
{
    public $active = false;
    public $name;
    public function mount($name)
    {

        $this->name = $name;
        $this->active = str_contains(Route::currentRouteName(), $name);
    }
    public function loadPage()
    {
        $this->active = true;
        return redirect()->route($this->name);
    }

    public function render()
    {
        return view('livewire.components.nav-link');
    }
}

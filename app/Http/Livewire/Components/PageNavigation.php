<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class PageNavigation extends Component
{
    public $needed_roles;
    public function mount($needed_roles)
    {
        $this->needed_roles = $needed_roles;
    }
    public function render()
    {
        $route_name = request()->route()->getName();
        $routes = explode('.', $route_name);
        $title = array_pop($routes);
        return view('livewire.components.page-navigation', compact('title'));
    }
}

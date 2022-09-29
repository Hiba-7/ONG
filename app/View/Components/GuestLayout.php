<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{

    public $padding;

    public function __construct($padding = 0) {
        $this->padding = $padding;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest');
    }
}

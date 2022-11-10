<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\User;

class Parametres extends Component
{
    public function render()
    {
        $progress = auth()->user()->Progress();
        $profile_percentage = $progress['percentage'];
        $is_incomplete = $progress['is_incomplete'];
        return view('livewire.pages.adherent.parametres', compact('profile_percentage', 'is_incomplete'));
    }
}
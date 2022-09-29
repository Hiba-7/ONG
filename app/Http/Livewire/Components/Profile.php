<?php

namespace App\Http\Livewire\Components;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Carte;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $user = auth()->user();
        $id = $user->id;
        $carte = User::find($id)->carte;
        return view('livewire.components.profile', compact('user'));
    }
}

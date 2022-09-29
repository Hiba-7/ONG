<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserCard extends Component
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.components.user-card');
    }
}

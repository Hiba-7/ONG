<?php

namespace App\Http\Livewire\Pages;

use App\Enums\UserRoleEnum;
use Livewire\Component;

class AdminRoute extends Component
{
    public $user, $roles, $needed_roles;
    public function render()
    {
        $this->user = auth()->user();
        $this->roles = $this->user->getRoleNames()->filter(function ($role) {
            return $role != UserRoleEnum::ADHERENT_SIMPLE->value;
        })->join(', ');
        $this->needed_roles = array_filter(UserRoleEnum::getValues(), function ($role) {
            return $role != UserRoleEnum::ADHERENT_SIMPLE->value;
        });


        return view('livewire.pages.admin-route', [
            'user' => $this->user,
            'roles' => $this->roles,
            'needed_roles' => $this->needed_roles
        ])
            ->layout(\App\View\Components\GuestLayout::class);
    }
}

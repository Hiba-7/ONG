<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Formation;
use Filament\Widgets\Widget;
use App\Enums\UserEtatProfileEnum;

class Inscription extends Widget
{
    public $formations, $formation, $sansniv;

    public function mount()
    {
        $this->formations =
            Formation::withCount(['adhérants as inscriptions' => fn ($query) => $query
                ->where('certifié', false)])
            ->get();

        $this->sansniv = User::has('formations', '=', 0)->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)->count();
    }
    protected static string $view = 'filament.widgets.inscription';
}

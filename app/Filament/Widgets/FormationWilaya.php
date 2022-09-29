<?php

namespace App\Filament\Widgets;

use App\Models\Wilaya;
use Filament\Widgets\Widget;
use App\Enums\UserCiviliteEnum;
use App\Enums\UserEtatProfileEnum;

class FormationWilaya extends Widget
{
    protected int | string | array $columnSpan = 1;
    public $wilayas, $users, $wilaya, $commune;
    public function mount()
    {
        $this->wilayas =
            Wilaya::withCount(['users as hommes' => fn ($query) => $query
                ->where('civilité', UserCiviliteEnum::MR->value)
                ->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)])
            ->withcount(['users as femmes' => fn ($query) => $query
                ->where('civilité', UserCiviliteEnum::MME->value)
                ->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)])
            ->withcount(['users as adhérants' => fn ($query) => $query
                ->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)])
            ->withcount(['communes as communesTot'])
            ->get();
    }
    protected static string $view = 'filament.widgets.Planning-wilaya';
}

<?php

namespace App\Filament\Widgets;

use App\Models\Wilaya;
use App\Models\Formation;
use Filament\Widgets\Widget;

class FormationWilaya extends Widget
{

    public $wilayas, $users, $wilaya, $commune, $formations, $formation;
    protected int | string | array $columnSpan = 1;
    public function mount()
    {
        $this->wilayas =
            Wilaya::withcount('users')->get();

        $this->formations = Formation::withcount('certifiés')->get();
    }
    protected static string $view = 'filament.widgets.formation-wilaya';
}
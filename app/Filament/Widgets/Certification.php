<?php

namespace App\Filament\Widgets;

use App\Models\Formation;
use Filament\Widgets\Widget;
use App\Enums\UserCiviliteEnum;

class Certification extends Widget
{
    public $formations, $formation, $table;

    public function mount()
    {
        $this->formations =
            Formation::withCount(['certifiés as certifications'])
            ->get();
    }
    protected static string $view = 'filament.widgets.certification';
}

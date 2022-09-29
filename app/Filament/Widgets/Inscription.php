<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Formation;
use Filament\Widgets\Widget;

class Inscription extends Widget
{
    public $formations, $formation, $sansniv;

    public function mount()
    {
        $this->formations =
            Formation::withCount(['users as inscriptions' => fn ($query) => $query
                ->where('certifié', false)])
            ->get();

        $this->sansniv =
            User::all()->count() - User::has('formations')->count();
    }
    protected static string $view = 'filament.widgets.inscription';
}

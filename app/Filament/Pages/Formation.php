<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\View\View;

use App\Filament\Widgets\Certification;
use App\Filament\Widgets\FormationChart;
use App\Filament\Widgets\FormationWilaya;
use App\Filament\Widgets\Inscription;
use App\Filament\Widgets\PlanningProchaine;
use Filament\Pages\Page;

class Formation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.formation';
    protected static ?string $navigationGroup = 'tableau de bord';


    protected function getHeaderWidgets(): array
    {
        return [
            Certification::class,
            Inscription::class,
            FormationChart::class,
            PlanningProchaine::class,

            FormationWilaya::class,


        ];
    }
}

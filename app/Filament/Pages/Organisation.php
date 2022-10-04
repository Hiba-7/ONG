<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdhérantAgeChart;
use App\Filament\Widgets\AdhérantGenreChart;
use App\Filament\Widgets\AdhérantWilaya;
use App\Filament\Widgets\StatsAdhérent;
use App\Models\Wilaya;
use Filament\Pages\Page;

use Illuminate\Contracts\View\View;

class Organisation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static string $view = 'filament.pages.organisation';
    protected static ?string $navigationGroup = 'tableau de bord';



    protected function getFooterWidgets(): array
    {
        return [
            AdhérantWilaya::class,


        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            StatsAdhérent::class,
            AdhérantAgeChart::class,
            AdhérantGenreChart::class,


        ];
    }
}

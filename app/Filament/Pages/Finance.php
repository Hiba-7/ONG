<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CotisationResource;
use App\Filament\Widgets\CotisationsTotal;
use App\Filament\Widgets\StatsAdhérent;
use App\Filament\Widgets\TotalCotisation;
use App\Filament\Widgets\TotalCotisationEtranger;
use App\Filament\Widgets\TotalCotisationLocal;
use App\Filament\Widgets\TotalCotisationSpecial;
use Filament\Pages\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Pages\Page;

class Finance extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.finance.finance';
    protected static ?string $navigationGroup = 'tableau de bord';

    public function getHeader(): View
    {
        return view('filament.pages.finance.header');
    }

    public function getFooter(): View
    {
        return view('filament.pages.finance.footer');
    }

    function getHeaderWidgets(): array
    {
        return [
            TotalCotisation::class,
            TotalCotisationLocal::class,
            TotalCotisationEtranger::class,
            TotalCotisationSpecial::class,
        ];
    }
}

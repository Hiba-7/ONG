<?php

namespace App\Filament\Pages;

use Filament\Pages\Actions\Action;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getActions(): array
    {
        return [
            Action::make('Finance')->url(route('filament.pages.finance'))->icon('heroicon-o-presentation-chart-bar'),
            Action::make('organisation')->url(route('filament.pages.organisation'))->icon('heroicon-o-presentation-chart-bar'),
            Action::make('formation')->url(route('filament.pages.formation'))->icon('heroicon-o-presentation-chart-bar'),
        ];
    }
}

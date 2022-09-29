<?php

namespace App\Filament\Resources\CotisationResource\Pages;

use App\Filament\Resources\CotisationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCotisation extends ViewRecord
{
    protected static string $resource = CotisationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

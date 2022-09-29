<?php

namespace App\Filament\Resources\CotisationResource\Pages;

use App\Filament\Resources\CotisationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCotisation extends EditRecord
{
    protected static string $resource = CotisationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

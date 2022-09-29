<?php

namespace App\Filament\Widgets;

use Closure;
use App\Models\User;
use Filament\Tables;
use App\Models\Planning;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class PlanningProchaine extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    protected function getTableQuery(): Builder
    {

        return Planning::query()->where('date_formation', '>=', today())->withCount('users as inscriptions');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('module.formation.nom')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('module.nom')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('lieu_formation')->sortable()->searchable(),

            Tables\Columns\TextColumn::make('date_formation')->sortable()->searchable()
                ->dateTime(),
            Tables\Columns\TextColumn::make('nom_formateur')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('inscriptions'),



        ];
    }
}

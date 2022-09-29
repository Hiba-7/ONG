<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Module;
use App\Models\Planning;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use App\Http\Livewire\Pages\Formation;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use App\Models\Formation as FormationModel;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;

class PlanningsRelationManager extends RelationManager
{
    protected static string $relationship = 'plannings';

    protected static ?string $recordTitleAttribute = 'date_formation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.formation.nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module.nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date_formation')->sortable()->searchable()->dateTime(),
                Tables\Columns\TextColumn::make('nom_formateur'),
                Tables\Columns\TextColumn::make('lieu_formation'),

                Tables\Columns\TextColumn::make('created_at')->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
            ])
            ->filters([
                DateFilter::make('date_formation')->label('Date formation'),
                DateFilter::make('updated_at')->label('Modifié le'),
                DateFilter::make('created_at')->label('Créé le'),

                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}

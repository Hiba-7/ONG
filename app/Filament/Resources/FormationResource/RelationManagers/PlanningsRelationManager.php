<?php

namespace App\Filament\Resources\FormationResource\RelationManagers;

use App\Filament\Resources\FormationResource;
use Filament\Forms;
use Filament\Tables;
use App\Models\Module;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use GuzzleHttp\Psr7\Request;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Livewire\Component as Livewire;


class PlanningsRelationManager extends RelationManager
{
    protected static string $relationship = 'plannings';

    protected static ?string $recordTitleAttribute = 'date_formation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('module_id')
                ->relationship('module','nom')
                ->required(),
                Forms\Components\DateTimePicker::make('date_formation')
                ->required(),
                 Forms\Components\TextInput::make('nom_formateur')
                ->required()
                ->maxLength(255),
                 ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_formation')->label('Date formation')->sortable()->searchable()
                    ->dateTime(),
                
                Tables\Columns\TextColumn::make('nom_formateur')->label('Formateur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module.nom')->label('Module')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Créé à')->sortable()->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Modifié à')->sortable()->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
            ])
            ->filters([
                    DateFilter::make('date_formation')->label('Date formation'),
                    DateFilter::make('updated_at')->label('Modifié le'),
                    DateFilter::make('created_at')->label('Créé le'),
                //
            ])
            ->headerActions([

                

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}


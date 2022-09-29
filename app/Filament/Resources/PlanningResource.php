<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Planning;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlanningResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use App\Filament\Resources\PlanningResource\RelationManagers;
use App\Filament\Resources\PlanningResource\RelationManagers\UsersRelationManager;

class PlanningResource extends Resource
{
    protected static ?string $model = Planning::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Formation';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('module_id')
                    ->relationship('module', 'nom')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_formation')
                    ->required(),

                Forms\Components\TextInput::make('nom_formateur')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lieu_formation')
                    ->required()
                    ->maxLength(255),
            ]);
    }
    public static function attachForm(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Select::make('module_id')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->required(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.formation.nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module.nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('lieu_formation')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('date_formation')->sortable()->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('nom_formateur')->searchable()->sortable(),
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [

         UsersRelationManager::class 
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlannings::route('/'),
            'create' => Pages\CreatePlanning::route('/create'),
            'view' => Pages\ViewPlanning::route('/{record}'),
            'edit' => Pages\EditPlanning::route('/{record}/edit'),
        ];
    }    
}

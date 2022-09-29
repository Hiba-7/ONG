<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Formation;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use RelationManagers\PostsRelationManager;
use App\Filament\Resources\FormationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use App\Filament\Resources\FormationResource\RelationManagers;
use Webbingbrasil\FilamentAdvancedFilter\Filters\NumberFilter;
use App\Filament\Resources\FormationResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\FormationResource\RelationManagers\ModulesRelationManager;
use App\Filament\Resources\FormationResource\RelationManagers\PlanningsRelationManager;
use App\Filament\Resources\FormationResource\RelationManagers\FormationsUsersRelationManager;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;
    protected static ?string $navigationGroup = 'Formation';


    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('niveau')
                ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')->label('Formation')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('niveau')->label('Niveau')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->toggleable(isToggledHiddenByDefault: false)->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('crée à')->sortable()->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Modifié à')->sortable()->toggleable(isToggledHiddenByDefault: true)
                    ->datetime(),
            ])
            ->filters([
                DateFilter::make('created_at')->label('Créé le'),
                DateFilter::make('updated_at')->label('Modifié le'),
                NumberFilter::make('niveau'),



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
            ModulesRelationManager::class,
            PlanningsRelationManager::class,
            UsersRelationManager::class,

        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'view' => Pages\ViewFormation::route('/{record}'),
            'edit' => Pages\EditFormation::route('/{record}/edit'),
        ];  
    }    
}

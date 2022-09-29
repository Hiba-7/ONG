<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Module;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

use App\Filament\Resources\ModuleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ModuleResource\RelationManagers;
use Webbingbrasil\FilamentAdvancedFilter\Filters\NumberFilter;
use App\Filament\Resources\ModuleResource\RelationManagers\PlanningsRelationManager;
use App\Filament\Resources\ModuleResource\RelationManagers\UsersRelationManager;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;
    protected static ?string $navigationGroup = 'Formation';


    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('formation_id')
                    ->relationship('formation', 'nom')
                    ->required(),
                Forms\Components\TextInput::make('numero')
                ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('formation.nom')->label('Formation')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('numero')->label('Numéro')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nom')->label('Nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->sortable()->searchable()->toggleable(),

            ])
            ->filters([
                SelectFilter::make('Formation')->relationship('formation', 'nom'),
                Filter::make('numero')->indicator('numero')

                ->form([
                    Forms\Components\TextInput::make('numero')->numeric(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['numero'],
                            fn (Builder $query, $data): Builder => $query->where('numero', '=', $data)
                        );
                       
                })

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
           PlanningsRelationManager::class,
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'view' => Pages\ViewModule::route('/{record}'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }    
}

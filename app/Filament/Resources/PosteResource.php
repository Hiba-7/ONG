<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PosteResource\RelationManagers\UsersRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\Poste;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PosteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PosteResource\RelationManagers;
use App\Models\Commune;
use App\Models\Wilaya;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;

class PosteResource extends Resource
{
    protected static ?string $model = Poste::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Organisation';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    Select::make('instance_id')->relationship('instance', 'nom')->label('Instance')->required(),
                    TextInput::make('nom')->required()->maxLength(255),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('instance.nom'),
                TextColumn::make('nom'),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPostes::route('/'),
            'create' => Pages\CreatePoste::route('/create'),
            'edit' => Pages\EditPoste::route('/{record}/edit'),
        ];
    }
}

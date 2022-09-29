<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CotisationResource\RelationManagers\UsersRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\Instance;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\InstanceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstanceResource\RelationManagers;
use App\Filament\Resources\InstanceResource\RelationManagers\CotisationRelationManager;
use App\Filament\Resources\InstancResource\RelationManagers\CotisationsRelationManager;
use App\Filament\Resources\InstancResource\RelationManagers\PostesRelationManager;
use Filament\Forms\Components\Checkbox;

class InstanceResource extends Resource
{
    protected static ?string $model = Instance::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-boards';
    protected static ?string $navigationGroup = 'Organisation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')->required()->maxLength(255),
                Checkbox::make('est_virtuelle')->inline(false)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')->searchable(),
                BooleanColumn::make('est_virtuelle')->sortable(),
                TextColumn::make('postes_count')->counts('postes')->label('#Postes'),
                TextColumn::make('users_count')->counts('users')->label('#Adherents'),
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
            CotisationsRelationManager::class,
            PostesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstances::route('/'),
            'create' => Pages\CreateInstance::route('/create'),
            'edit' => Pages\EditInstance::route('/{record}/edit'),
        ];
    }
}

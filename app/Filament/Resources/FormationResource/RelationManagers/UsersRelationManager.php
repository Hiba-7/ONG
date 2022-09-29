<?php

namespace App\Filament\Resources\FormationResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('nom')->searchable()->sortable(),
                TextColumn::make('prénom')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('adresse'),
                TextColumn::make('téléphone'),

            ])
            ->filters([])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [

                        Forms\Components\select::make('user_id')->options(User::all()->pluck('nom', 'prénom'))
                            ->required(),
                        // Forms\Components\select::make('prénom')->options(User::all()->pluck('prénom'))
                        //     ->required(),

                        Forms\Components\Checkbox::make('certifié')->required(),
                        Forms\Components\DatePicker::make('date_inscription')->required(),
                        Forms\Components\DatePicker::make('date_certification')->required(),

                    ])
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
};

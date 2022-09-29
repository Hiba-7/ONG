<?php

namespace App\Filament\Resources\InstancResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\TypeCotisationEnum;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CotisationsRelationManager extends RelationManager
{
    protected static string $relationship = 'cotisations';

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations de la cotisation')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('type')->disabled()->default(TypeCotisationEnum::SPECIAL->value),
                        TextInput::make('montant')->numeric()->required()->placeholder(0),
                        DatePicker::make('année')->required(),
                        // Select::make('instance_id')->relationship('instance', 'nom'),
                    ])
                ]),
                Section::make('Dates de la cotisation')->schema([
                    Grid::make(2)->schema([
                        DatePicker::make('délai_paiement')->required()->after('année'),
                        DatePicker::make('dernier_délai_paiement')->required()->after('délai_paiement'),
                    ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('montant')
                    ->sortable()
                    ->searchable()
                    ->money(fn (Model $record) => $record->type == 'simple_etranger' ? 'eur' : 'dzd'),
                Tables\Columns\TextColumn::make('année'),
                Tables\Columns\TextColumn::make('délai_paiement'),
                Tables\Columns\TextColumn::make('dernier_délai_paiement'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

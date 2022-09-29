<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\TypeCotisationEnum;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Filament\Resources\RelationManagers\RelationManager;

class CotisationsRelationManager extends RelationManager
{
    protected static string $relationship = 'cotisations';

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')->options(TypeCotisationEnum::getValues())->required(),
                Select::make('validé_par')->options(User::adminFinance()->pluck('nom', 'id'))->required(),
                TextInput::make('montant_ajouté')->required(),
                DatePicker::make('date_paiement')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('montant')
                    ->searchable()
                    ->money(fn (Model $record) => $record->type == 'simple_etranger' ? 'eur' : 'dzd'),
                Tables\Columns\TextColumn::make('montant_ajouté')
                    ->searchable()
                    ->money(fn (Model $record) => $record->type == 'simple_etranger' ? 'eur' : 'dzd'),
                Tables\Columns\TextColumn::make('validé_par')->searchable(),
                Tables\Columns\TextColumn::make('date_paiement')->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        DatePicker::make('date_paiement')->default(now()),
                        Select::make('validé_par')->options(User::adminFinance()->pluck('nom', 'id')),
                        TextInput::make('montant_ajouté')->numeric()->required()->default(0)->minValue(0),
                    ])->afterFormValidated(function (array $data) {
                        $data['validé_par'] = auth()->user()->id;
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Instance;
use App\Models\Cotisation;
use Illuminate\Support\Arr;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use App\Enums\TypeCotisationEnum;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Notifications\Collection;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use SebastianBergmann\Comparator\TypeComparator;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CotisationResource\Pages;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use App\Filament\Resources\CotisationResource\RelationManagers;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use App\Filament\Resources\CotisationResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\CotisationResource\RelationManagers\InstanceRelationManager;
use App\Filament\Resources\CotisationResource\RelationManagers\InstancesRelationManager;

class CotisationResource extends Resource
{
    protected static ?string $model = Cotisation::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations de la cotisation')->schema([
                    Grid::make(2)->schema([
                        Select::make('type')->options(TypeCotisationEnum::getValues())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('instance_id', null)),
                        Select::make('instance_id')
                            ->label('Instance')
                            ->options(Instance::all()->pluck('nom')),
                        // function (callable $get) {
                        //     if (!$get('type') || $get('type') == TypeCotisationEnum::special->value) {
                        //         return Instance::orderBy('nom')->pluck('nom', 'id');
                        //     }
                        //     return [];
                        // }

                        TextInput::make('montant')->numeric()->required(),
                        DatePicker::make('année')->required(),
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
                Tables\Columns\TextColumn::make('type')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->sortable()
                    ->searchable()
                    ->money(fn (Model $record) => $record->type == 'simple_etranger' ? 'eur' : 'dzd'),
                Tables\Columns\TextColumn::make('année')->date()
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('délai_paiement')->sortable(),
                Tables\Columns\TextColumn::make('dernier_délai_paiement')->sortable(),
                Tables\Columns\TextColumn::make('instance.nom'),
            ])
            ->filters([
                SelectFilter::make('type')->options(TypeCotisationEnum::getValues()),
                SelectFilter::make('instance_id')->relationship('instance', 'nom')->label('Instance'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('diffuser Users')->action(
                    function (EloquentCollection $records) {
                        $records->each(function (Model $record) {
                            if ($record->type == TypeCotisationEnum::SIMPLE_LOCAL->value) {
                                return $record->users()->syncWithoutDetaching(User::local()->get());
                            } elseif ($record->type == TypeCotisationEnum::SIMPLE_ETRANGER->value) {
                                return $record->users()->syncWithoutDetaching(User::etranger()->get());
                            } elseif ($record->type == TypeCotisationEnum::SPECIAL->value) {
                                return $record->users()->syncWithoutDetaching(User::whereHas('instances', function ($query) use ($record) {
                                    $query->where('instances.id', $record->instance_id);
                                })->get());
                            }
                        });
                    }
                )->requiresConfirmation()->deselectRecordsAfterCompletion()->icon('heroicon-o-user-group'),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCotisations::route('/'),
            'create' => Pages\CreateCotisation::route('/create'),
            'view' => Pages\ViewCotisation::route('/{record}'),
            'edit' => Pages\EditCotisation::route('/{record}/edit'),
        ];
    }
}

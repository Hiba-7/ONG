<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Pays;
use App\Models\User;
use Filament\Tables;
use App\Models\Commune;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\UserCiviliteEnum;
use Filament\Resources\Resource;
use App\Enums\UserEtatSocialEnum;
use App\Enums\UserEtatProfileEnum;
use App\Enums\UserNiveauEtudeEnum;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\PostesRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\InstancesRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\PlanningsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\FormationsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\CotisationsRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $title = 'Adhérants';
    protected static ?string $label = 'Adhérants';
    public ?Model $record = null;

    protected static ?string $navigationLabel = "Adhérants";
    protected static ?string $slug = 'Adhérants';


    // protected static bool $shouldRegisterNavigation = auth()->user()->hasRole('super_admin') ?? false;


    protected static ?string $navigationIcon = 'heroicon-o-user-group';



    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(3)->schema([
                Wizard::make([
                    Wizard\Step::make('Profile Information')->schema([
                        Card::make([
                            Grid::make(3)->schema([
                                TextInput::make('email')->email()->required(),
                                TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create'),
                                Select::make('etat_profile_courant')->options(UserEtatProfileEnum::getNames())->required(),
                                Toggle::make('fondateur')->inline(false)->required(),
                            ]),
                        ]),
                    ]),
                    Wizard\Step::make('Personal Information')->schema([
                        Card::make([
                            Grid::make(3)->schema([
                                Select::make('civilité')->options(UserCiviliteEnum::getNames())->required(),
                                DatePicker::make('date_naissance')->required(),
                                TextInput::make('nom')->required(),
                                TextInput::make('prénom')->required(),
                                TextInput::make('téléphone')->tel()->required(),
                                TextInput::make('adresse')->required(),
                                TextInput::make('adresse_secondaire'),
                                Select::make('pays_id')->label('Pays')
                                    ->options(Pays::all()->pluck('nom', 'id'))
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('commune_id', null))
                                    ->searchable()
                                    ->required(),
                                Select::make('commune_id')->label('Commune')
                                    ->options(function (callable $get) {
                                        if ($get('pays_id') == 4) {
                                            return Commune::exceptLast()->pluck('nom', 'id');
                                        }
                                        return Commune::where('id', Commune::count())->pluck('nom', 'id');
                                    })
                                    ->searchable()
                                    ->required(),
                            ]),
                        ]),
                    ]),
                    Wizard\Step::make('CV')->schema([
                        Card::make([
                            Grid::make(2)->schema([
                                TextInput::make('spécialité')->required(),
                                TextInput::make('fonction')->required(),
                                Select::make('niveau_etude')->options(UserNiveauEtudeEnum::getNames())->required(),
                                Select::make('etat_social')->options(UserEtatSocialEnum::getNames())->required(),
                            ]),
                        ]),
                    ]),
                ])->columnSpan(3)
            ])
        ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('civilité')->sortable(),
                TextColumn::make('nom')->searchable(),
                TextColumn::make('prénom')->searchable(),
                BooleanColumn::make('fondateur'),
                TextColumn::make('commune.nom'),
                TextColumn::make('commune.wilaya.nom'),
                TextColumn::make('pays.nom'),
                TextColumn::make('date_admission')->Date(),
            ])
            ->filters([
                SelectFilter::make('etat_profile_courant')->options(UserEtatProfileEnum::getNames()),
                SelectFilter::make('etat_social')->options(UserEtatSocialEnum::getNames()),
                SelectFilter::make('niveau_etude')->options(UserNiveauEtudeEnum::getNames()),
                Filter::make('fondateur')->query(fn (Builder $query) => $query->where('fondateur', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            PlanningsRelationManager::class,
            FormationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),

        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['nom', 'prénom', 'email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'nom' => $record->nom,
            'prénom' => $record->prénom,
        ];
    }
}

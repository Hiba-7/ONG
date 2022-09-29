<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Wilaya;
use App\Models\Commune;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Http\Livewire\Pages\Instance;
use Filament\Tables\Actions\EditAction;
use App\Models\Instance as InstanceModel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DetachBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Filters\SelectFilter;

class PostesRelationManager extends RelationManager
{
    protected static string $relationship = 'postes';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date_début')->required(),
                DatePicker::make('date_fin')->after('date_début'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instance.nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nom')->searchable(),
                Tables\Columns\TextColumn::make('date_début')->date()->sortable(),
                Tables\Columns\TextColumn::make('date_fin')->date()->sortable(),

            ])
            ->filters([
                SelectFilter::make('instance_id')->relationship('instance', 'nom')->label('Instance'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\DatePicker::make('date_début')->required(),
                        Forms\Components\DatePicker::make('date_fin')->required()->after('date_début'),
                    ])->preloadRecordSelect(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DetachBulkAction::make(),
            ]);
    }
}

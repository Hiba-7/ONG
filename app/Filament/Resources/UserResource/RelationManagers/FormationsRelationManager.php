<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Http\Livewire\Pages\Formation;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class FormationsRelationManager extends RelationManager
{
    protected static string $relationship = 'formations';

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
                TextColumn::make('niveau')->searchable()->sortable(),
                TextColumn::make('date_inscription')->searchable()->sortable(),
                TextColumn::make('certifié')->searchable()->sortable(),
                TextColumn::make('date_certification')->searchable()->sortable(),
                // !a column where it displays the number of modules the user has attended
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Checkbox::make('certifié'),
                        Forms\Components\DatePicker::make('date_inscription')->required(),
                        Forms\Components\DatePicker::make('date_certification'),
                    ])->preloadRecordSelect(),
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
}

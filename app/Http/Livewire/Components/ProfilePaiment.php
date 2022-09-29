<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Filament\Tables;
use App\Enums\TypeCotisationEnum;
use App\Models\Cotisation;
use App\Models\Module;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;

class ProfilePaiment extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;


    protected function getTableQuery(): Builder
    {
        return Cotisation::query();
    }
    protected function getTableColumns(): array

    {

        return [

            TextColumn::make('année')->label('Date')->sortable(),

            TextColumn::make('nom')->sortable(),

            TextColumn::make('description')->sortable(),
            TextColumn::make('date_formation')->label('Date formation')->sortable(),
            TextColumn::make('nom_formateur')->label('Formateur')->sortable(),


        ];
    }



    public function render(): View
    {
        $user = auth()->user();
        // we get the last cotisation of the user
        // cotisation simple can be either local or foreign
        // cotisation speciale is a special cotisation related to an instance
        // we get the last cotisation of each type

        $cotisation_simple = $user->cotisations()->where('type', TypeCotisationEnum::SIMPLE_LOCAL)->orWhere('type', TypeCotisationEnum::SIMPLE_ETRANGER)->orderBy('created_at', 'desc')->first();
        $cotisation_speciale = $user->cotisations()->where('type', TypeCotisationEnum::SPECIAL)->orderBy('created_at', 'desc')->orderBy('created_at', 'desc')->first();
        // we check if the cotisation is payed
        $est_payee = $cotisation_simple->est_paye ?? false;
        $est_payee_speciale = $cotisation_speciale->est_paye ?? false;

        // we get the montant of the cotisation
        $montant_simple = $cotisation_simple->montant ?? 0;
        $montant_speciale = $cotisation_speciale->montant ?? 0;




        return view('livewire.components.profile-paiment', compact('user', 'montant_simple', 'montant_speciale', 'est_payee', 'est_payee_speciale'));
    }
}

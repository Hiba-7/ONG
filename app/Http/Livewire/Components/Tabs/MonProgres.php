<?php

namespace App\Http\Livewire\Components\Tabs;

use App\Models\Formation;
use App\Models\Instance;
use App\Models\Module;
use App\Models\Poste;
use App\Models\User;
use Closure;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MonProgres extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $vide;

    protected function getTableQuery(): Builder
    {
        // returner la requete qui nous donne les modules de l'utilisateur connecté
        return Module::query()->join('formations', 'formations.id', '=', 'modules.formation_id')
            ->join('formation_user', 'formation_user.formation_id', '=', 'formations.id')
            ->where('formation_user.user_id', auth()->user()->id)
            ->select('modules.*', 'formations.nom as formation_nom');
    }
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('numero'),
            TextColumn::make('nom'),
            TextColumn::make('formation_nom')->label('Formation'),
        ];
    }

    // public function getTableRecordUrlUsing(): Closure
    // {
    //     return fn (Module $module): string => route('accueil', ['module' => $module]);
    // }



    protected function getTableFilters(): array

    {

        return [];
    }



    protected function getTableActions(): array

    {

        return [Tables\Actions\ViewAction::make()->form(fn (ViewAction $action): array => [

            TextInput::make('nom')->disabled()->placeholder(auth()->user()->nom . ' ' . auth()->user()->prénom),
            Textarea::make('description'),
        ])];
    }



    protected function getTableBulkActions(): array

    {

        return [];
    }


    public function mount()
    {
        $this->vide = $this->getTableQuery()->count() == 0;
    }
    public function render()
    {
        return view('livewire.components.tabs.mon-progres');
    }
}

<?php

namespace App\Http\Livewire\Components\Tabs;

use App\Models\Formation;
use App\Models\Module;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Niveau extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public  $numero;
    public string $description;
    public $formation;
    public bool $inscrit;
    protected function getTableQuery(): Builder
    {
        return Module::query()
            ->where('formation_id', $this->formation->id)
            ->join('plannings', 'plannings.module_id', '=', 'modules.id')
            ->select('*');
    }
    protected function getTableColumns(): array

    {

        return [

            TextColumn::make('numero')->sortable()->searchable(),

            TextColumn::make('nom')->sortable()->searchable(),

            TextColumn::make('description')->sortable()->searchable(),
            TextColumn::make('date_formation')->label('Date formation')->searchable()->sortable(),
            TextColumn::make('nom_formateur')->label('Formateur')->searchable()->sortable(),


        ];
    }



    protected function getTableFilters(): array

    {

        return [];
    }



    protected function getTableActions(): array

    {

        return [];
    }



    protected function getTableBulkActions(): array

    {

        return [];
    }


    public function inscriptionClickHandler()
    {
        $user_id = auth()->user()->id;
        if (!$this->inscrit) {
            $this->inscrit = true;
            $this->formation->users()->attach($user_id);
        }
        //refresh the page
        return redirect(request()->header('Referer'));
    }
    public function desinscriptionClickHandler()
    {
        $user_id = auth()->user()->id;
        if ($this->inscrit) {
            $this->inscrit = false;
            $this->formation->users()->detach($user_id);
        }
        //refresh the page
        return redirect(request()->header('Referer'));
    }


    public function mount($formation)
    {
        $this->inscrit = $formation->users()->where('user_id', auth()->user()->id)->exists();
        $this->numero = $formation->numero;
        Log::info($this->numero);
        $this->formation = $formation;
        $this->description = $formation->description;
    }
    public function render()
    {
        return view('livewire.components.tabs.niveau');
    }
}

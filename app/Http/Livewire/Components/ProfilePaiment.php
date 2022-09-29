<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Filament\Tables;
use App\Enums\TypeCotisationEnum;
use App\Models\Cotisation;
use App\Models\Paiement;
use App\Models\Module;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Pagination\Paginator;

class ProfilePaiment extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;


    protected function getTableQuery(): Builder
    {
        return Paiement::where('user_id', auth()->id())->whereYear('created_at', '!=', now()->year);
    }
    protected function getTableColumns(): array

    {

        return [

            TextColumn::make('created_at')->label('Date')->sortable(),

            TextColumn::make('cotisation.type')->label('Nom')->sortable(),

            TextColumn::make('description')->label('Description')->sortable(),

            TextColumn::make('cotisation.montant')->label('Total')->sortable()


        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->simplePaginate($this->getTableRecordsPerPage() == -1 ? $query->count() : $this->getTableRecordsPerPage());
    }

    public function render(): View
    {
        $user = User::find(auth()->id());
        // $carte = User::find($id)->carte;
        $current_cotisations = $user->paiements()->whereYear('created_at', now()->year)->get();
        return view('livewire.components.profile-paiment', compact('user', 'current_cotisations'));
    }
}

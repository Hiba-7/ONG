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
use DateTime;

class ProfilePaiement extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;


    protected function getTableQuery(): Builder
    {
        return Paiement::where('user_id', auth()->id())->whereYear('created_at', '!=', now()->year);
    }
    protected function getTableColumns(): array

    {

        return [

            TextColumn::make('created_at')
                ->formatStateUsing(fn (string $state): string => date('d/m/Y', strtotime($state)))
                ->label('Date')
                ->sortable(),

            TextColumn::make('cotisation.type')->label('Type')->sortable()->enum([
                'simple_local' => 'Cotisation Simple',
                'simple_étranger' => 'Cotisation Simple',
                'spécial' => 'Cotisation Spécial',
            ]),

            TextColumn::make('instance')->label('Details'),

            TextColumn::make('cotisation.montant')->label('Total')->money('DZD')->sortable()


        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->simplePaginate($this->getTableRecordsPerPage() == -1 ? $query->count() : $this->getTableRecordsPerPage());
    }

    public function render(): View
    {
        $current_paiements = Paiement::where('user_id', auth()->id())
            ->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])
            ->with('cotisation:id,type')
            ->get();
        // $carte = User::find($id)->carte;
        return view('livewire.components.profile-paiement', compact('current_paiements'));
    }
}

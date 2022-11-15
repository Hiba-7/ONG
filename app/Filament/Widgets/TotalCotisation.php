<?php

namespace App\Filament\Widgets;

use App\Models\Paiement;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TotalCotisation extends BaseWidget
{
    public $paiements_count = 0;
    public $paiements_payée_count = 0;
    public $paiements_non_payée_count = 0;

    public $montant_total = 0;
    public $montant_payé = 0;
    public $montant_dette = 0;

    public function mount()
    {
        // get the paiements that were created this year
        $paiements = Paiement::whereHas('cotisation', function ($query) {
            $query->whereYear('année', now()->year);
        })->get();
        $this->paiements_count = $paiements->count();
        foreach ($paiements as $paiement) {
            $this->montant_total += $paiement->cotisation_total;
            if ($paiement->est_payée) {
                $this->montant_payé += $paiement->cotisation_total;
                $this->paiements_payée_count++;
            } else {
                $this->montant_dette += $paiement->cotisation_total;
                $this->paiements_non_payée_count++;
            }
        }
    }

    protected function getCards(): array
    {
        $percentage_payé = $this->montant_total > 0 ? round($this->montant_payé / $this->montant_total * 100) : 0;
        $percentage_non_payé = $this->montant_total > 0 ? round($this->montant_dette / $this->montant_total * 100) : 0;

        return [
            Card::make('', null)->description('Cotisations total'),
            Card::make('Assiettes de cotisations', money($this->montant_total, 'DZD'))
                ->description($this->paiements_count),
            Card::make('Recouveremnt', money($this->montant_payé, 'DZD'))
                ->description($percentage_payé . '%')->color('success'),
            Card::make('Dettes', money($this->montant_dette, 'DZD'))
                ->description($percentage_non_payé . '%')->color('danger'),
        ];
    }
}

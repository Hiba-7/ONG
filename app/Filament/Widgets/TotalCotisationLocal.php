<?php

namespace App\Filament\Widgets;

use App\Enums\TypeCotisationEnum;
use App\Models\Paiement;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TotalCotisationLocal extends BaseWidget
{

    public $paiements_count = 0;
    public $paiements_payée_count = 0;
    public $paiements_non_payée_count = 0;

    public $montant_total = 0;
    public $montant_payé = 0;
    public $montant_dette = 0;

    public function mount()
    {
        $paiements = Paiement::whereHas('cotisation', function ($query) {
            $query->whereYear('année', now()->year);
        })->localCotisation()->get();
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
        $precentage_payé = $this->paiements_count > 0 ? round($this->paiements_payée_count / $this->paiements_count * 100) : 0;
        $precentage_non_payé = $this->paiements_count > 0 ? round($this->paiements_non_payée_count / $this->paiements_count * 100) : 0;
        return [
            Card::make('Assiettes de cotisations', money($this->montant_total, 'DZD'))
                ->description($this->paiements_count),
            Card::make('Recouveremnt', money($this->montant_payé, 'DZD'))
                ->description($this->paiements_payée_count . ' ', $precentage_payé . '%'),
            Card::make('Dettes', money($this->montant_dette, 'DZD'))
                ->description($this->paiements_non_payée_count . ' ', $precentage_non_payé . '%'),
        ];
    }
}

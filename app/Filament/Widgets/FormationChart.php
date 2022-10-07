<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Formation;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Enums\UserEtatProfileEnum;
use Filament\Widgets\BarChartWidget;

class FormationChart extends BarChartWidget
{
    protected static ?string $heading = 'Formations par niveau ';
    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {

        $certification =  Formation::withCount([
            'certifiés as certifications' => fn ($query) => $query
        ])
            ->pluck('certifications');
        $certification->prepend(0);
        $inscription =   Formation::withCount(['adhérants as inscriptions' => fn ($query) => $query
            ->where('certifié', false)])
            ->pluck('inscriptions');
        $inscription->prepend(0);


        $sansniv[] = User::has('formations', '=', 0)->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)->count();
        $sansniv[] = 0;
        return [
            'datasets' => [
                [
                    'label' => 'Certifications',
                    'data' => $certification,
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    'borderColor' => [

                        'rgb(54, 162, 235)',
                    ],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Inscriptions',
                    'data' => $inscription,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    'borderColor' => [

                        'rgb(255, 99, 132)',
                    ],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Sans niveau',
                    'data' => $sansniv,
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    'borderColor' => [

                        'rgb(75, 192, 192)',
                    ],
                    'borderWidth' => 1
                ],

            ],
            'options' =>
            [
                'scale' =>
                [
                    'ticks' =>
                    [
                        'precision' => 0
                    ]

                ]
            ],
            'labels'  => ['niveau 0', 'niveau 1', 'niveau 2', 'niveau 3', 'niveau 4', 'niveau 5'],

        ];
    }
}

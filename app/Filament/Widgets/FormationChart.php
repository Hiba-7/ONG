<?php

namespace App\Filament\Widgets;

use App\Models\Formation;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\BarChartWidget;

class FormationChart extends BarChartWidget
{
    protected static ?string $heading = 'Formations par niveau ';
    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {

        return [
            'datasets' => [
                [
                    'label' => 'Certifications',
                    'data' => Formation::withCount(['users as certifications' => fn ($query) => $query
                        ->where('certifié', true)])
                        ->pluck('certifications'),
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
                    'data' => Formation::withCount(['users as certifications' => fn ($query) => $query
                        ->where('certifié', false)])
                        ->pluck('certifications'),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    'borderColor' => [

                        'rgb(255, 99, 132)',
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
            'labels'  => ['niveau 1', 'niveau 2', 'niveau 3', 'niveau 4', 'niveau 5'],

        ];
    }
}

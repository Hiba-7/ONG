<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\PieChartWidget;

class AdhérantGenreChart extends PieChartWidget
{
    protected static ?string $heading = 'Adhérant';
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 1;
    public ?string $filter = 'today';
    protected function getData(): array
    {
        $activeFilter = $this->filter;
        return [
            'datasets' => [
                [

                    'data' => [
                        DB::table('users')
                            ->where([
                                ['etat_profile_courant', '=', 'ADHERENT'],
                                ['civilité', '=', 'MME'],
                            ])
                            ->count(),
                        DB::table('users')
                            ->where([
                                ['etat_profile_courant', '=', 'ADHERENT'],
                                ['civilité', '=', 'MR'],
                            ])
                            ->count()
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    'hoverOffset' => 30
                ],
            ],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            'labels' => [
                'Femme',
                'Homme'
            ],
        ];
    }
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}

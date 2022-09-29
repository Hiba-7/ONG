<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\BarChartWidget;

class AdhérantAgeChart extends BarChartWidget
{

    protected static ?string $heading = 'Chart';
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 3;
    protected function getData(): array
    {

        $thirties = 0;
        $forties = 0;
        $twenties = 0;
        $fifties = 0;
        $sexties = 0;
        $users = User::all();
        foreach ($users as $user) {
            if ($user->age() < 30) :  $twenties++;
            elseif ($user->age() < 40) :  $thirties++;
            elseif ($user->age() < 50) :  $forties++;
            elseif ($user->age() < 60) :  $fifties++;
            elseif ($user->age() >= 60) :  $sexties++;




            endif;
        }
        return [
            'datasets' => [

                [
                    'label' => 'My First Dataset',
                    'data' => [$twenties, $thirties, $forties, $fifties, $sexties],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)'
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels'  => ['30', '40', '50', '60', '+60'],

        ];
    }
}

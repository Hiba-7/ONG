<?php

namespace App\Filament\Widgets;

use App\Enums\UserCiviliteEnum;
use App\Enums\UserEtatProfileEnum;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAdhérent extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Adhérants', DB::table('users')
                ->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)
                ->count()),



            Card::make('Hommes', DB::table('users')
                ->where([
                    ['etat_profile_courant', UserEtatProfileEnum::ADHERENT->value],
                    ['civilité', UserCiviliteEnum::MR->value],
                ])
                ->count()),



            Card::make('Femmes', DB::table('users')
                ->where([
                    ['etat_profile_courant', UserEtatProfileEnum::ADHERENT->value],
                    ['civilité', UserCiviliteEnum::MME->value],
                ])
                ->count()),

        ];
    }
}

<?php

namespace App\Enums;


enum UserEtatProfileEnum: string
{
    case DEMANDE_ADMISSION = "demande_admission";
    case ADHERENT = "adherent";
    case EX_ADHERENT = "ex_adherent";
    case GELE = "gele"; // FROZEN

    public static function getValues(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[$case->name] = $case->value;
        }
        return $values;
    }
    // this function is specific to Filament Select Inputs
    public static function getNames(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[$case->value] = $case->name;
        }
        return $values;
    }
}

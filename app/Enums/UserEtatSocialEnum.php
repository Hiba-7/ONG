<?php

namespace App\Enums;


enum UserEtatSocialEnum: string
{
    case ACTIF = "Actif";
    case ETUDIANT = "Étudiant";
    case RECHERCHE = "Recherche";
    case RETRAITE = "Retraite";

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

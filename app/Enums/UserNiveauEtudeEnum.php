<?php

namespace App\Enums;

enum UserNiveauEtudeEnum: string
{
    case PRIMAIRE = "Primaire";
    case SECONDAIRE = "Secondaire";
    case LYCEEN = "Lycéen";
    case UNIVERSITAIRE = "Universitaire";

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

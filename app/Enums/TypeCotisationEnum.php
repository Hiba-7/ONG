<?php

namespace App\Enums;


enum TypeCotisationEnum: string
{
    case SIMPLE_ETRANGER = 'simple_étranger';
    case SIMPLE_LOCAL = 'simple_local';
    case SPECIAL = 'spécial';

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

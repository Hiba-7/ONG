<?php

namespace App\Enums;


enum UserRoleEnum: string
{
    case SUPER_ADMIN = 'super_admin'; // can view and modify ?
    case ADMIN_FINANCE = 'admin_finance'; // accept the payment
    case ADMIN_FORMATION = 'admin_formation'; // chargé formation,  accpet adherents to formation
    case ADMIN_ORGANISATION = 'admin_organisation'; //  can view all instances and adherents
    case ADMIN_SIMPLE = 'admin_simple'; // can only view  everything
    case COORDINATEUR = 'coordinateur'; // validate the admission of "les adherents"
    case ADHERENT_SIMPLE = 'adherent_simple'; // can view his data

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

    public static function getAdminRoles(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            if (strpos($case->value, 'admin') !== false || $case->value == 'coordinateur') {
                $values[$case->name] = $case->value;
            }
        }
        return $values;
    }

    public static function getAdminRolesAsPipelinedString()
    {
        return implode('|', self::getAdminRoles());
    }
}

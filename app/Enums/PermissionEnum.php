<?php

namespace App\Enums;


enum PermissionEnum: string
{
    case VIEW_USERS = 'view_users';
    case CREATE_USERS = 'create-users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';

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

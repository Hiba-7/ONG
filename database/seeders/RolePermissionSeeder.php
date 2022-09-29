<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\UserRoleEnum;
use App\Enums\PermissionEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // empty the tables
        Permission::query()->delete();
        Role::query()->delete();

        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // insert roles
        $roles = [];
        foreach (UserRoleEnum::getValues() as $role) {

            $roles[] = [
                'name' => $role,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Role::insert($roles);

        // insert permissions
        $permissions = [];
        foreach (PermissionEnum::getValues() as $permission) {

            $permissions[] = [
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Permission::insert($permissions);

        foreach(Role::all() as $role) {
            $role->givePermissionTo(Permission::all());
        }
    }
}

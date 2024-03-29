<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRoleEnum;
use App\Models\Poste;
use App\Models\Cotisation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        parent::call(PaysSeeder::class);

        parent::call(WilayaCommuneSeeder::class);

        parent::call(CotisationSeeder::class);

        parent::call(RolePermissionSeeder::class);

        parent::call(InstancePosteSeeder::class);

        parent::call(FormationModuleSeeder::class);

        parent::call(PlanningSeeder::class);


        User::factory(1)->create([
            'nom' => "Mohammedi",
            'prénom' => "Taha",
            'email' => "mohammeditaha33@gmail.com",
            'password' => "password"

        ]);
        // create the super admin
        User::factory(1)->create([
            'email' => 'b@c.com'
        ]);

        // assign the super admin role
        User::find(1)->assignRole(UserRoleEnum::getAdminRoles());

        // create the rest of the users
        User::factory(9)->create();

    }
}

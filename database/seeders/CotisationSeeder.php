<?php

namespace Database\Seeders;

use App\Enums\TypeCotisationEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CotisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cotisation simple local
        $cot = \App\Models\Cotisation::create([
            'type' => 'simple_local',
            'montant' => 1200,
            'instance_id' => 1,
        ]);


        // cotisation simple étranger
        \App\Models\Cotisation::create([
            'type' => 'simple_étranger',
            'montant' => 1500,
            'instance_id' => 1,
        ]);

        // cotisation special
        \App\Models\Cotisation::create([
            'type' => 'spécial',
            'montant' => 1500,
            'instance_id' => 1,
        ]);
    }
}

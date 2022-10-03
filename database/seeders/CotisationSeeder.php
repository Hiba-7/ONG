<?php

namespace Database\Seeders;

use App\Enums\TypeCotisationEnum;
use Doctrine\DBAL\Types\Type;
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
        \App\Models\Cotisation::create([
            'type' => TypeCotisationEnum::SIMPLE_LOCAL->value,
            'montant' => 1200,
            'instance_id' => 1,
            'année' => now(),
            'délai_paiement' =>now()->addMonth(),
            'dernier_délai_paiement' => now()->addMonths(3),
            
        ]);
        
        
        // cotisation simple étranger
        \App\Models\Cotisation::create([
            'type' => TypeCotisationEnum::SIMPLE_ETRANGER->value,
            'montant' => 1500,
            'instance_id' => 1,
            'année' => now(),
            'délai_paiement' =>now()->addMonth(),
            'dernier_délai_paiement' => now()->addMonths(3),
        ]);

        // cotisation special
        \App\Models\Cotisation::create([
            'type' => TypeCotisationEnum::SPECIAL->value,
            'montant' => 1500,
            'instance_id' => 1,
            'année' => now(),
            'délai_paiement' =>now()->addMonth(),
            'dernier_délai_paiement' => now()->addMonths(3),
        ]);
    }
}

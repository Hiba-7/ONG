<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormationModuleSeeder extends Seeder
{
    

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('formations')) {
            Artisan::call('migrate');
        }

        Schema::disableForeignKeyConstraints();
        Formation::truncate();
        $this->insertFormations();
        $this->insertModules();

        return;
    }
    protected function insertFormations()
    {
        // Load instance from json
        $formations_json = json_decode(file_get_contents(database_path('seeders/json/Formations.json')));
        // Insert instance
        $data = [];
        foreach ($formations_json as $formation) {
            $data[] = [
                'nom'   => $formation->nom,
                'niveau'  => $formation->niveau,
                'description'  => $formation->description,
                'created_at' => now(),
                'updated_at' => now(),

                
            ];
        }
        Formation::insert($data);
    }

    protected function insertModules()
    {
        // Load instance from json
        $modules_json = json_decode(file_get_contents(database_path('seeders/json/Modules.json')));
        // Insert instance
        $data = [];
        foreach ($modules_json as $module) {
            $data[] = [
                'nom'   => $module->nom,
                'numero'  => $module->numero,
                'description'  => $module->description,
                'formation_id'  => $module->formation_id,
                'created_at' => now(),
                'updated_at' => now(),


                
            ];
        }
        Module::insert($data);
    }

}

<?php

namespace Database\Seeders;

use App\Models\Planning;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('plannings')) {
            Artisan::call('migrate');
        }

        Planning::truncate();
        $this->insertPlannings();

        return;
    }
    protected function insertPlannings()
    {
        // Load planning from json
        $planning_json = json_decode(file_get_contents(database_path('seeders/json/Planning.json')));
        // Insert planning
        $data = [];
        foreach ($planning_json as $planning) {
            $data[] = [
                'nom_formateur'   => $planning->nom_formateur,
                'module_id'  => $planning->module_id,
                'date_formation' => now(),
                'lieu_formation' => $planning->lieu_formation,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Planning::insert($data);
    }
}

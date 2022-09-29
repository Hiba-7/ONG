<?php

namespace Database\Seeders;

use App\Models\Instance;
use App\Models\Poste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class InstancePosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('instances') || !Schema::hasTable('postes')) {
            Artisan::call('migrate');
        }

        Schema::disableForeignKeyConstraints();
        Instance::truncate();
        Poste::truncate();
        $this->insertInstances();
        $this->insertPostes();
        return;
    }
    protected function insertInstances()
    {
        // Load instance from json
        $instances_json = json_decode(file_get_contents(database_path('seeders/json/Instances.json')));
        // Insert instance
        $data = [];
        foreach ($instances_json as $instance) {
            $data[] = [
                'nom'   => $instance->nom,
                'est_virtuelle'  => $instance->est_virtuelle,
            ];
        }
        Instance::insert($data);
    }

    protected function insertPostes()
    {
        // Load Postes from json
        $postes_json = json_decode(file_get_contents(database_path('seeders/json/Postes.json')));
        // Insert Postes
        $data = [];
        foreach ($postes_json as $poste) {
            $data[] = [
                'nom'   => $poste->nom,
                'instance_id'  => $poste->instance_id,
            ];
        }
        Poste::insert($data);
    }
}

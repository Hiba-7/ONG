<?php

namespace Database\Seeders;

use App\Models\Pays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;


class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('pays')) {
            Artisan::call('migrate');
        }

        if (!Pays::count()) {   
            $this->insertPays();
            $this->command->info("Success!! pays are loaded successfully");
            return;
        }

        $this->command->comment("Pays already loaded");
    }

    protected function insertPays()
    {
        // Load pays from json
        $pays_json = json_decode(file_get_contents(database_path('seeders/json/countries.json')));

        // Insert pays
        $data = [];
        foreach ($pays_json as $pays) {
            $data[] = [
                'nom'   => $pays->name,
                'code'  => $pays->code,
            ];
        }
        Pays::insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilaya;
use App\Models\Commune;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class WilayaCommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilaya_rows = 59;
        $commune_rows = 1542;
        if (Wilaya::count() != $wilaya_rows || Commune::count() != $commune_rows) {

            Schema::disableForeignKeyConstraints();
            Commune::truncate();
            Wilaya::truncate();
            
            $this->insertWilayas();
            $this->insertCommunes();
            $this->command->info("Success!! wilayas and communes are loaded successfully");
            
            return;
        }
        $this->command->comment("Communes & Wilayas already loaded");
    }

    protected function insertWilayas()
    {
        // Load wilayas from json
        $wilayas_json = json_decode(file_get_contents(database_path('seeders/json/Wilaya_Of_Algeria.json')));

        // Insert Wilayas
        $data = [];
        foreach ($wilayas_json as $wilaya) {
            $data[] = [
                'id'        => $wilaya->id,
                'nom'       => $wilaya->name,
                'nom_arabe' => $wilaya->ar_name,
            ];
        }
        Wilaya::insert($data);
    }

    protected function insertCommunes()
    {
        // Load wilayas from json
        $communes_json = json_decode(file_get_contents(database_path('seeders/json/Commune_Of_Algeria.json')));

        // Insert communes
        $data = [];
        foreach ($communes_json as $commune) {
            $data[] = [
                'id'          => $commune->id,
                'nom'         => $commune->name,
                'nom_arabe'   => $commune->ar_name,
                'code_postal' => $commune->post_code,
                'wilaya_id'   => $commune->wilaya_id,
            ];
        }
        Commune::insert($data);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Pays;
use App\Models\Wilaya;

class PaysController
{
    /**
     * Get all pays.
     */
    public function index()
    {
        return Pays::all();
    }

    /**
     * Get a specified Wilaya.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return Pays::findOrFail($id);
    }

    /**
     * Get wilayas of pays_id.
     *
     * @param  int  $id
     */
    public function wilayas($id)
    {
        return Wilaya::all();
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  string  $q
     */
    public function search($q)
    {
        return Wilaya::all();
    }
}

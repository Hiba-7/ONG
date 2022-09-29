<?php

namespace App\Http\Controllers\Api;

use App\Models\Commune;

class CommuneController
{
    /**
     * Get all Communes.
     */
    public function index()
    {
        // return all communes except the last one
        return Commune::exceptLast();
    }

    /**
     * Get a specified Commune.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return Commune::findOrFail($id);
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  string  $q
     */
    public function search($q)
    {
        return Commune::where('name', 'like', "%$q%")
                        ->orWhere('arabic_name', 'like', "%$q%")
                        ->get();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Commune;
use App\Models\Wilaya;

class WilayaController
{
    /**
     * Get all wilayas.
     */
    public function index()
    {
        // return all wilayas except the last one
        return Wilaya::exceptLast();
    }

    /**
     * Get a specified Wilaya.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return Wilaya::findOrFail($id);
    }

    /**
     * Get communes of wilayas_id.
     *
     * @param  int  $id
     */
    public function communes($id)
    {
        return Commune::where('wilaya_id', $id)->get();
    }
    
    /**
     * Search wilaya by name or arabic_name
     *
     * @param  string  $q
     */
    public function search($q)
    {
        return Wilaya::where('name', 'like', "%$q%")
                        ->orWhere('arabic_name', 'like', "%$q%")
                        ->get();
    }
}

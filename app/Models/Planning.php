<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Formation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planning extends Model


{
    use HasFactory;
    protected $fillable = [
        'date_formation',
        'nom_formateur',
        'module_id',
        'lieu_formation',
    ];
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
     public function formation()
     {
         return $this->hasOneThrough(Formation::class, Module::class);
     }
}

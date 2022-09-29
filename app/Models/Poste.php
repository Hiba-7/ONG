<?php

namespace App\Models;

use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Instance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'instance_id',
        'date_début',
        'date_fin',
    ];

    /* pivot tables */

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['date_début', 'date_fin'])
            ->withTimestamps();
    }

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }

    public function cotisation()
    {
        return $this->hasOneThrough(Cotisation::class, Instance::class);
    }
}

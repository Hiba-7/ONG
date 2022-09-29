<?php

namespace App\Models;

use App\Models\Planning;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'formation_id',
        'nom_formateur',
        'nom',
        'description'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
    //  public function users()
    //  {
    //      return $this->hasManyThrough(User::class,Planning::class);
    //  }
}

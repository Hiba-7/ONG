<?php

namespace App\Models;


use App\Models\Module;
use App\Models\User;
use App\Models\Planning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'niveau',
        'nom',
        'description'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('certifié', 'date_inscription', 'date_certification');
    }
    public function certifiés()
    {
        return $this->users()->wherePivot('certifié', true);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function plannings()
    {
        return $this->hasManyThrough(Planning::class, Module::class);
    }
}

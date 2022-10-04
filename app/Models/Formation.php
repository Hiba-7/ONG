<?php

namespace App\Models;


use App\Models\User;
use App\Models\Module;
use App\Models\Planning;
use App\Enums\UserEtatProfileEnum;
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
        return $this->users()->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value)
            ->wherePivot('certifié', true);
    }
    public function adhérants()
    {
        return $this->users()->where('etat_profile_courant', UserEtatProfileEnum::ADHERENT->value);
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

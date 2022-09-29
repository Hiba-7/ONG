<?php

namespace App\Models;

use App\Models\Commune;
use App\Enums\UserEtatProfileEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Wilaya extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "nom_arabe",
        "pays_id",
    ];
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Commune::class);
    }

    public function inscriptions()
    {
        return $this->users()->withcount('formations as formations');
    }

    public function certifiés()
    {
        return $this->users()->where('certifié', true);
    }
    public function adhérants()
    {
        return $this->users()->where('users.etat_profile_courant', UserEtatProfileEnum::ADHERENT->value);
    }


    public static function exceptLast()
    {
        return Wilaya::where('id', '!=', Wilaya::count())->get();
    }
}

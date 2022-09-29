<?php

namespace App\Models;

use App\Models\User;
use App\Models\Instance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'montant',
        'année',
        'instance_id',
        'délai_paiement',
        'dernier_délai_paiement',
    ];

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['montant_ajouté', 'est_payée', 'date_paiement', 'validé_par'])
            ->withTimestamps()
            ->using(Paiement::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function postes()
    {
        return $this->hasManyThrough(Poste::class, Instance::class);
    }
}

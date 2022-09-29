<?php

namespace App\Models;

use App\Enums\TypeCotisationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Pivot
{
    use HasFactory;

    protected $table = 'cotisation_user';

    protected $fillable = [
        'montant_ajouté',
        'est_payée',
        'date_paiement',
        'validé_par',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'cotisation_total',
    ];

    protected $casts = [
        'cotisation_total' => 'decimal:2',
    ];


    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCotisationTotalAttribute()
    {
        return $this->montant_ajouté + $this->cotisation()->pluck('montant', 'type')->first();
    }

    public function scopeLocalCotisation($query)
    {
        $query->whereHas('cotisation', function ($query) {
            $query->where('type', TypeCotisationEnum::SIMPLE_LOCAL->value);
        });
    }

    public function scopeEtrangerCotisation($query)
    {
        $query->whereHas('cotisation', function ($query) {
            $query->where('type', TypeCotisationEnum::SIMPLE_ETRANGER->value);
        });
    }

    public function scopeSpecialCotisation($query)
    {
        $query->whereHas('cotisation', function ($query) {
            $query->where('type', TypeCotisationEnum::SPECIAL->value);
        });
    }
}

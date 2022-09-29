<?php

namespace App\Models;

use App\Models\Poste;
use App\Models\Cotisation;
use Filament\Tables\Filters\Concerns\HasRelationship;
use Illuminate\Database\Eloquent\Concerns\HasRelationships as ConcernsHasRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Instance extends Model
{
    use HasFactory, HasRelationships;

    protected $fillable = [
        'nom',
        'est_virtuelle',
    ];

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }

    public function postes()
    {
        return $this->hasMany(Poste::class);
    }
    
    public function users()
    {
        return $this->hasManyDeep(User::class, [Poste::class, 'poste_user']);
    }
}

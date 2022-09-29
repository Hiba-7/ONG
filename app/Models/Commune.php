<?php

namespace App\Models;

use App\Models\Poste;
use App\Models\Wilaya;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Commune extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'nom_arabe',
        'code_postal',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function scopeExceptLast($query)
    {
        return $query->where('id', '!=', Commune::count());
    }
}

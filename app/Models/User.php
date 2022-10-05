<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleEnum;
use Filament\Forms\Commands\InstallCommand;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use \Znck\Eloquent\Traits\BelongsToThrough;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable implements FilamentUser, HasName
{



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasRelationships, BelongsToThrough;

    public function getFilamentName(): string
    {
        return "{$this->prénom} {$this->nom}";
    }

    // , FilamentUser
    public function canAccessFilament(): bool
    {
        return $this->hasAnyRole(UserRoleEnum::getAdminRoles());
    }

    protected $fillable = [
        'civilité',
        'nom',
        'prénom',
        'date_naissance',
        'email',
        'téléphone',
        'fondateur',
        "etat_profile_courant",
        'adresse',
        'adresse_secondaire',
        'photo_profile',
        'spécialité',
        'fonction',
        'niveau_etude',
        'etat_social',
        'pays_id',
        'commune_id',
        'nom_departement',
        'password',
        'date_admission',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plannings()
    {
        return $this->belongsToMany(Planning::class);
    }

    public function modules()
    {
        return $this->hasManyThrough(Module::class, Planning::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class)
            ->withPivot(['certifié', 'date_certification', 'date_inscription'])
            ->withTimestamps();
    }

    public function cotisations()
    {
        return $this->belongsToMany(Cotisation::class)
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
        return $this->belongsToMany(Poste::class)
            ->withPivot(['date_début', 'date_fin'])
            ->withTimestamps();
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function wilaya()
    {
        return $this->belongsToThrough(Wilaya::class, Commune::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function carte()
    {
        return $this->hasOne(Carte::class);
    }

    public function instances()
    {
        return $this->hasManyDeepFromReverse((new Instance())->users());
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes["password"] = bcrypt($password);
    }

    public function scopeAdminFinance($query)
    {
        return $query->role(UserRoleEnum::ADMIN_FINANCE->value);
    }

    public function scopeLocal($query)
    {
        return $query->where('pays_id', 4);
    }

    public function scopeEtranger($query)
    {
        return $query->where('pays_id', '!=', 4);
    }
    public function age()
    {
        return Carbon::parse($this->attributes['date_naissance'])->age;
    }
}

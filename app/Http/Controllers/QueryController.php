<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Paiement;
use App\Models\Formation;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use App\Enums\UserCiviliteEnum;
use App\Enums\TypeCotisationEnum;
use App\Enums\UserEtatProfileEnum;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function mehdi()
    {
        return User::find(1)->cotisations()->where('type', TypeCotisationEnum::SPECIAL)->orderBy('created_at', 'desc')->orderBy('created_at', 'desc')->first();
    }

    public function nassim()
    {
        return Wilaya::withCount('users')->get();
    }

    public function hiba()
    {
        return;
    }

    public function taha()
    {
        return Paiement::find(1)->getCotisationTotalAttribute();
    }
}

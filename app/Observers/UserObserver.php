<?php

namespace App\Observers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Cotisation;
use App\Models\Carte;
use App\Models\VoteCarte;
use Illuminate\Support\Carbon;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $cotisation = collect();
        if ($user->pays_id == 4) {
            $cotisation = Cotisation::where('type', 'simple_local')->first();
        } else {
            $cotisation = Cotisation::where('type', 'simple_étranger')->latest()->first();
        }
        $user->cotisations()->attach($cotisation->id, []);

        $user->assignRole(UserRoleEnum::ADHERENT_SIMPLE->value);

        $carte = new Carte();
        $user->carte()->save($carte);

        $vote_carte = new VoteCarte();
        $user->vote_carte()->save($vote_carte);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
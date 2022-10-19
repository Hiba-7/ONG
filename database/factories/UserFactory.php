<?php

namespace Database\Factories;

use App\Enums\UserCiviliteEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\UserEtatProfileEnum;
use App\Enums\UserEtatSocialEnum;
use App\Enums\UserNiveauEtudeEnum;
use App\Models\Commune;
use App\Models\Pays;
use App\Models\Carte;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // ? do we really need the carte_id as a foreign key?
        return [
            'civilité' => fake()->randomElement(UserCiviliteEnum::cases()),
            'nom' => fake()->lastName(),
            'prénom' => fake()->firstName(),
            'fondateur' => fake()->boolean(),
            'date_naissance' => fake()->date(),
            'téléphone' => fake()->phoneNumber('0#########'),
            'etat_profile_courant' => fake()->randomElement(UserEtatProfileEnum::cases()),
            'adresse' => fake()->address(),
            'photo_profile' => fake()->imageUrl(),
            'niveau_etude' => fake()->randomElement(UserNiveauEtudeEnum::cases()),
            'etat_social' => fake()->randomElement(UserEtatSocialEnum::cases()),
            'spécialité' => fake()->sentence(),
            'fonction' => fake()->sentence(),
            'pays_id' => Pays::inRandomOrder()->first()->id,
            'commune_id' => Commune::inRandomOrder()->first()->id,
            'nom_departement' => fake()->word(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => "test1234",
            //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
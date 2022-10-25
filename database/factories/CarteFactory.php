<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carte>
 */
class CarteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "scan" => null,
            "numero" => null,
            "date_delivrance" => null,
            "date_expiration" => null,
            "lieu_delivrance" => null,
            "user_id" => User::inRandomOrder()->first()->id,
        ];
    }
}
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
            "scan" => "1660831025.jpg",
            "numero" => fake()->creditCardNumber(),
            "date_delivrance" => fake()->date(),
            "date_expiration" => fake()->date(),
            "user_id" => User::inRandomOrder()->first()->id,
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
     return [
           'uuid' => Str::uuid(),
           'nom' => fake()->lastName(),
           'prenom' => fake()->firstName(),
           'date_naissance' => fake()->date(),
           'adresse' => fake()->address(),
           'telephone' => '+221' . fake()->numerify('77#######'),
           'cni' => fake()->unique()->numerify('1############'),
       ];

    }
}

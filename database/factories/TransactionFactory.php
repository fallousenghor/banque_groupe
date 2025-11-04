<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
           'type' => fake()->randomElement(['depot', 'retrait']),
           'montant' => fake()->randomFloat(2, 1000, 10000),
           'description' => fake()->sentence(),
           'date_transaction' => now(),
           'statut' => 'validee',
       ];

    }
}

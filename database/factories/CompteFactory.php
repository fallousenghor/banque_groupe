<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Reference\Reference;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
           'numero_compte' => 'CPT-' . date('Y') . '-' . strtoupper(fake()->bothify('?????')),
           'titulaire' => fake()->name(),
           'type_compte' => fake()->randomElement(['epargne', 'cheque']),
           'solde_initial' => fake()->randomFloat(2, 10000, 100000),
           'devise' => 'XOF',
           'statut' => 'actif',
           'date_creation' => now(),
           'metadonnees' => ['derniere_modification' => now(), 'version' => 1],
       ];
   }
}

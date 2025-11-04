<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;
use App\Models\Compte;
use App\Models\Transaction;

class ClientSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
   public function run(): void
   {
       Client::factory()->count(10)->create()->each(function ($client) {
           // Creer un utilisateur associe pour chaque client
           $user = User::factory()->create([
               'authenticatable_type' => Client::class,
               'authenticatable_id' => $client->uuid,
           ]);


           // Creer 1 à 3 comptes pour chaque client avec le bon
           Compte::factory()->count(rand(1, 3))->create([
               'client_id' => $client->uuid,
               'titulaire' => $client->nom . ' ' . $client->prenom,
           ])->each(function ($compte) {
               // Optionnel: Creer des transactions pour chaque compte
               Transaction::factory()->count(rand(1, 5))->create([
                   'compte_id' => $compte->id,
               ]);
           });


       });
   }
}

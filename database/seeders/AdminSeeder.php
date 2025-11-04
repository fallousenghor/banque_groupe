<?php


namespace Database\Seeders;


use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AdminSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      
       Admin::factory()->count(5)->create()->each(function ($admin) {
           // Creer un utilisateur associe pour chaque admin
           $user = \App\Models\User::factory()->create([
               'authenticatable_type' => Admin::class,
               'authenticatable_id' => $admin->id,
               'is_active' => true,
           ]);
       });


   }
}

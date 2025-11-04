<?php


namespace App\Services;


use App\Models\Compte;




class CompteService
{
   public function calculerSolde(Compte $compte): float
   {
       $depotTotal = $compte->transactions()
           ->where('type_transaction', 'depot')
           ->sum('montant');


       $retraitTotal = $compte->transactions()
           ->where('type_transaction', 'retrait')
           ->sum('montant');


       $virementTotal = $compte->transactions()
           ->where('type_transaction', 'virement')
           ->sum('montant');


       $fraisTotal = $compte->transactions()
           ->where('type_transaction', 'frais')
           ->sum('montant');


       return $compte->solde_initial + $depotTotal - $retraitTotal - $virementTotal - $fraisTotal;
   }
}

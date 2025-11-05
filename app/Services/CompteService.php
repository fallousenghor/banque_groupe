<?php

namespace App\Services;

use App\Models\Compte;

class CompteService
{
    public function calculerSolde(Compte $compte): float
    {
        $depotTotal = $compte->transactions()
            ->where('type', 'depot')
            ->sum('montant');

        $retraitTotal = $compte->transactions()
            ->where('type', 'retrait')
            ->sum('montant');

        $virementTotal = $compte->transactions()
            ->where('type', 'virement')
            ->sum('montant');

        $fraisTotal = $compte->transactions()
            ->where('type', 'frais')
            ->sum('montant');

        return $compte->solde_initial + $depotTotal - $retraitTotal - $virementTotal - $fraisTotal;
    }

    public function getAllComptes($queryParams = [])
    {

        return Compte::with(['transactions'])
            ->search($queryParams['search'] ?? null)
            ->sortAndOrder($queryParams['sort'] ?? null, $queryParams['order'] ?? null)
            ->paginatePageAndLimit($queryParams['page'] ?? 1, $queryParams['limit'] ?? 10);
    }
}

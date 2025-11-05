<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    /**
     * @OA\Schema(
     *     schema="Compte",
     *     type="object",
     *     title="Compte Bancaire",
     *     description="Représentation d'un compte bancaire",
     *
     *     @OA\Property(property="id", type="string", format="uuid", example="2a7f99ac-0e3e-458a-a3ff-bbc55f0553d1", description="Identifiant unique du compte"),
     *     @OA\Property(property="numeroCompte", type="string", example="CPT-2025-ORFMS", description="Numéro du compte"),
     *     @OA\Property(property="titulaire", type="string", example="Adams Juliana", description="Nom du titulaire du compte"),
     *     @OA\Property(property="type", type="string", enum={"epargne", "cheque"}, example="cheque", description="Type de compte"),
     *     @OA\Property(property="solde", type="number", format="float", example=72366.69, description="Solde actuel du compte"),
     *     @OA\Property(property="devise", type="string", example="XOF", description="Devise du compte"),
     *     @OA\Property(property="dateCreation", type="string", format="date-time", example="2025-11-03T19:29:36.000000Z", description="Date de création du compte"),
     *     @OA\Property(property="statut", type="string", enum={"actif", "bloque", "ferme"}, example="actif", description="Statut du compte"),
     *     @OA\Property(property="clientId", type="string", format="uuid", example="a4c4c2b7-3a22-4512-9121-165b63d96445", description="Identifiant du client propriétaire"),
     *     @OA\Property(
     *         property="informations_blocage",
     *         type="object",
     *         nullable=true,
     *         description="Informations de blocage pour les comptes épargne bloqués",
     *         @OA\Property(property="motifBlocage", type="string", example="Inactivité prolongée"),
     *         @OA\Property(property="dateBlocage", type="string", format="date-time", nullable=true, example="2025-11-04T18:37:42.286Z"),
     *         @OA\Property(property="dateDeblocagePrevue", type="string", format="date-time", nullable=true, example="2025-12-04T18:37:42.286Z"),
     *         @OA\Property(property="motifDeblocage", type="string", nullable=true, example="Fin de période"),
     *         @OA\Property(property="dateDeblocage", type="string", format="date-time", nullable=true, example="2025-12-04T18:37:42.286Z")
     *     ),
     *     @OA\Property(
     *         property="metadata",
     *         type="object",
     *         nullable=true,
     *         description="Métadonnées personnalisées du compte",
     *         @OA\Property(property="derniere_modification", type="string", format="date-time", example="2025-11-03T19:29:36.348032Z"),
     *         @OA\Property(property="version", type="integer", example=1)
     *     )
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulaire' => $this->titulaire,
            'numero_compte' => $this->numero_compte,
            'solde_initial' => $this->solde_initial,
            'devise' => $this->devise,
            'solde' => $this->solde,
            'statut' => $this->statut,
            'date_creation' => $this->date_creation,
            'client_id' => $this->client_id,
            'informations_blocage' => $this->when(
                $this->type === 'epargne' && ($this->statut === 'bloque' || $this->dateBlocage !== null),
                [
                    'motifBlocage' => $this->motifBlocage,
                    'dateBlocage' => $this->dateBlocage?->toISOString(),
                    'dateDeblocagePrevue' => $this->dateDeblocagePrevue?->toISOString(),
                    'motifDeblocage' => $this->motifDeblocage,
                    'dateDeblocage' => $this->dateDeblocage?->toISOString(),
                ]
            ),
            'metadata' => $this->metadonnees,
        ];
    }
}

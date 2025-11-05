<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompteResource;
use App\Services\CompteService;
use App\Traits\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 *     name="Comptes",
 *     description="API Endpoints pour la gestion des comptes bancaires"
 * )
 */
class CompteController extends Controller
{
    use RestResponse;

    protected $compteService;

    public function __construct(CompteService $compteService)
    {
        $this->compteService = $compteService;
    }
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/v1/comptes",
     *     operationId="getComptesList",
     *     tags={"Comptes"},
     *     summary="Récupérer la liste des comptes",
     *     description="Retourne une liste paginée des comptes bancaires avec possibilité de filtrage et tri",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Numéro de la page (défaut: 1)",
     *         required=false,
     *
     *         @OA\Schema(type="integer", minimum=1, example=1)
     *     ),
     *
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Nombre d'éléments par page (défaut: 10, max: 100)",
     *         required=false,
     *
     *         @OA\Schema(type="integer", minimum=1, maximum=100, example=10)
     *     ),
     *
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Rechercher par titulaire ou numéro de compte",
     *         required=false,
     *
     *         @OA\Schema(type="string", example="")
     *     ),
     *
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filtrer par type de compte",
     *         required=false,
     *
     *         @OA\Schema(type="string", enum={"epargne", "cheque"}, example="")
     *     ),
     *
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Champ de tri (défaut: created_at)",
     *         required=false,
     *
     *         @OA\Schema(type="string", enum={"created_at", "titulaire", "solde", "statut"}, example="created_at")
     *     ),
     *
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Ordre de tri (défaut: desc)",
     *         required=false,
     *
     *         @OA\Schema(type="string", enum={"asc", "desc"}, example="desc")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Liste des comptes récupérée avec succès",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Comptes récupérés avec succès."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *
     *                 @OA\Items(ref="#/components/schemas/Compte")
     *             ),
     *
     *             @OA\Property(
     *                 property="pagination",
     *                 type="object",
     *                 @OA\Property(property="currentPage", type="integer", example=1),
     *                 @OA\Property(property="totalPages", type="integer", example=5),
     *                 @OA\Property(property="totalItems", type="integer", example=48),
     *                 @OA\Property(property="itemsPerPage", type="integer", example=10),
     *                 @OA\Property(property="hasNext", type="boolean", example=true),
     *                 @OA\Property(property="hasPrevious", type="boolean", example=false)
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                 @OA\Property(property="self", type="string", example="http://localhost:8000/api/v1/comptes?page=1&limit=10"),
     *                 @OA\Property(property="next", type="string", example="http://localhost:8000/api/v1/comptes?page=2&limit=10"),
     *                 @OA\Property(property="previous", type="string", nullable=true, example=null),
     *                 @OA\Property(property="first", type="string", example="http://localhost:8000/api/v1/comptes?page=1&limit=10"),
     *                 @OA\Property(property="last", type="string", example="http://localhost:8000/api/v1/comptes?page=5&limit=10")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while fetching comptes.")
     *         )
     *     )
     * )
     *
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            Log::info('Fetching all comptes with filters: ', $request->all());
            $queryParams = $request->query();

            // Utilisation du service pour obtenir tous les comptes
            $comptes = $this->compteService->getAllComptes($queryParams);

            return $this->successResponse(
                CompteResource::collection($comptes),
                'Comptes recupérés avec succès.',
                $this->paginatedData($comptes),
                $this->getLinksData($comptes)
            );
        } catch (\Exception $e) {
            Log::error('Error fetching comptes: '.$e->getMessage());

            return $this->errorResponse('An error occurred while fetching comptes.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
* @OA\Info(
*     version="1.0.0",
*     title="API Gestion Comptes Bancaires",
*     description="API RESTful pour la gestion des comptes bancaires et transactions. Cette API permet de gérer les comptes bancaires, les transactions, et les clients.",
*     @OA\Contact(
*         email="tapha.ednayas313@gmail.com",
*         name="Support API"
*     ),
*     @OA\License(
*         name="MIT",
*         url="https://opensource.org/licenses/MIT"
*     )
* )
*
* @OA\Server(
*     url="http://localhost:8000",
*     description="Serveur de développement local"
* )
*
* @OA\Server(
*     url="https://senghor-fallou-gestion-comptes-api.onrender.com",
*     description="Serveur de production (Render)"
* )
*
* @OA\SecurityScheme(
*     securityScheme="bearerAuth",
*     type="http",
*     scheme="bearer",
*     bearerFormat="JWT",
*     description="Authentification via Bearer Token"
* )
*
* @OA\Tag(
*     name="Health",
*     description="Endpoints de santé de l'API"
* )
*
* @OA\Tag(
*     name="Comptes",
*     description="Gestion des comptes bancaires"
* )
*
* @OA\Tag(
*     name="Transactions",
*     description="Gestion des transactions"
* )
*
* @OA\Tag(
*     name="Clients",
*     description="Gestion des clients"
* )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

<?php

namespace App\Http\Controllers\Api\V1\Profil;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Resources\ProfilRessource;
use App\Http\Services\Profils\ProfilService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfilController extends Controller
{
    public function __construct(private ProfilService $profilService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $profils = $this->profilService->getAllProfilActif();
       return ProfilRessource::collection($profils);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProfileRequest $request)
    {
        //on renvoie les données au service qui est chargé d'effectuer les transformations si nécessaire
        $profilCreated = $this->profilService->createProfil($request);
        if (!$profilCreated) {
            return response()->json('une erreur est survenue dans la création du profil', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(["message" => 'Profil Crée avec succès'], Response::HTTP_CREATED);


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

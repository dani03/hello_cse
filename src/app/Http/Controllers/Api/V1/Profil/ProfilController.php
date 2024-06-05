<?php

namespace App\Http\Controllers\Api\V1\Profil;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
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
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $profils = $this->profilService->getAllProfilActif();

        return response()->json(ProfilRessource::collection($profils), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProfileRequest $request): \Illuminate\Http\JsonResponse
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
    public function update(UpdateProfileRequest $request, int $id)
    {
        //recupération du profil adéquat
        $profil = $this->profilService->getProfil($id);
        if (!$profil) {
            return response()->json(["message" => "aucun profil trouvé."], Response::HTTP_NOT_FOUND);
        }



        $profilUpdated = $this->profilService->updateProfil($profil, $request);

        if ($profilUpdated->wasChanged()) {
            return response()->json(['message' => ' profil mis à jour avec succès', "data" => ProfilRessource::make($profilUpdated)], Response::HTTP_OK);
        }
        return response()->json(['message' => 'aucun changement effectué'], Response::HTTP_NOT_MODIFIED);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        //récuperation du profil
        $profil = $this->profilService->getProfil($id);
        if (!$profil) {
            return response()->json(['message' => 'Ce profil n\'existe pas. '], Response::HTTP_NOT_FOUND);
        }
        $profil->delete();
        if ($profil->delete()) {
            return response()->json(['message' => 'Profil supprimé.'], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Une erreur est survenue, impossible de supprimer le profil.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

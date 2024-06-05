<?php

namespace App\Http\Services\Profils;

use App\Enums\Status;
use App\Http\Repositories\Profils\ProfilRepository;
use App\Http\Requests\CreateProfileRequest;
use App\Models\Profil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;

class ProfilService
{

    public function __construct(private ProfilRepository $profilRepository)
    {
    }

    public function createProfil(CreateProfileRequest $request)
    {
        $file = $request->file('image');
        $file_path = $this->saveImageProfil($file);
        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'file_path' => $file_path,
        ];
        $dataOfProfil = collect($data);

        return $this->profilRepository->create($dataOfProfil);
    }

    public function saveImageProfil(object $file)
    {
        $nameFile = $file->getClientOriginalName();
        $randomName = $file->hashName();
        $random = explode(".", $randomName);
        $finalFileName = $random[0] . "-" . $nameFile;
        return $file->storeAs('images', $finalFileName);
    }


    public function getAllProfilActif()
    {
        return $this->profilRepository->findAllProfilActif();
    }

    public function getProfil(int $profilId): Profil|null
    {
        return $this->profilRepository->findProfil($profilId);
    }

    public function updateProfil(Profil $profil, $request)
    {
        //traitement des données si un nouveau fichier est upload alors on supprime l'ancien
        // et on le remplace par le nouveau
        if ($request->file('image')) {
            self::deleteExistingFile($profil->image);
            $path_file = $this->saveImageProfil($request->file('image'));
            if (!$path_file) {
                return "false";
            }
        }
        if ($request->has('status')) {

            $newStatus = $this->getValueOfStatus($request->status);
        }

        $data = [
            'nom' => $request->nom ?? $profil->nom,
            "prenom" => $request->prenom ?? $profil->prenom,
            "image" => $path_file ?? $profil->image,
            "status" => $newStatus ?? $profil->status,
        ];
        $this->profilRepository->update($profil, $data);
        return $profil;

    }

    public static function deleteExistingFile(string $pathToFile): bool
    {
        if (Storage::exists($pathToFile)) {
            return Storage::delete($pathToFile);
        }
        return false;

    }

    public function getValueOfStatus( $requestStatus): int|string
    {

        //vérification si le status donné est dans la liste des status prédéfinie
        //si oui on vérifie s'il fait parti des values ou des labels
        if (is_int($requestStatus) || is_numeric($requestStatus)) {
            $requestStatus = (int) $requestStatus;
            $statusValue = in_array($requestStatus, Status::allStatusValues(), true);
            if ($statusValue) {
                return (Status::fromValue($requestStatus))->value;
            }

        }
            $statusLabel = in_array($requestStatus, Status::allStatusLabel(), true);
            if ($statusLabel) {
                return (Status::fromLabel($requestStatus))->label();
            }

            return (Status::INACTIF)->value;
        // si le status envoyé n'est pas dans les status prédéfinie on le met inactif

    }

}

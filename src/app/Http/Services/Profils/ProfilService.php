<?php

namespace App\Http\Services\Profils;

use App\Http\Repositories\Profils\ProfilRepository;
use App\Http\Requests\CreateProfileRequest;

class ProfilService
{

    public function __construct(private ProfilRepository $profilRepository)
    {
    }

    public function createProfil(CreateProfileRequest $request) {
        $file = $request->file('image');
        $file_path = $this->saveImageProfil($file);
        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'file_path' => $file_path,
        ];
       $dataOfProfil =  collect($data);

       return $this->profilRepository->create($dataOfProfil);
    }

    public function saveImageProfil(Object $file) {
        $nameFile = $file->getClientOriginalName();
        $randomName = $file->hashName();
        $random = explode(".", $randomName);
        $finalFileName = $random[0]."-".$nameFile;
       return $file->storeAs('images', $finalFileName);
    }


    public function getAllProfilActif() {
       return $this->profilRepository->findAllProfilActif();
    }

}

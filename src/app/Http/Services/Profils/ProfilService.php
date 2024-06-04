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
       $dataOfProfil =  collect($request->all());
       return $this->profilRepository->create($dataOfProfil);
    }

}

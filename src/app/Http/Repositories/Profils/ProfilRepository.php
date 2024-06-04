<?php

namespace App\Http\Repositories\Profils;

use App\Enums\Status;
use App\Models\Profil;
use Illuminate\Support\Collection;

class ProfilRepository
{
    public function create(Collection $profil)
    {
        return Profil::create(
            [
                "nom" => $profil->get('nom'),
                "prenom" => $profil->get('prenom'),
                "status" => Status::EN_ATTENTE,
                "image" => $profil->get('file_path')
            ]
        );
    }

    public function findAllProfilActif() {
        return Profil::where('status', Status::ACTIF)->get();
    }

}

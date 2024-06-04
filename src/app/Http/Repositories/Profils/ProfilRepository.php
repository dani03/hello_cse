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
                "name" => $profil->get('name'),
                "prenom" => $profil->get('prenom'),
                "status" => Status::EN_ATTENTE,
                "image" => $profil->get('file_path')
            ]
        );
    }

}

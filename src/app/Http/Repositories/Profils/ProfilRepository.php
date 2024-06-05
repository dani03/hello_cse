<?php

namespace App\Http\Repositories\Profils;

use App\Enums\Status;
use App\Models\Profil;
use Illuminate\Support\Collection;

class ProfilRepository
{
    public function create(Collection $profil)
    {
        //création d'un nouveau profil
        return Profil::create(
            [
                "nom" => $profil->get('nom'),
                "prenom" => $profil->get('prenom'),
                "status" => Status::EN_ATTENTE,
                "image" => $profil->get('file_path')
            ]
        );
    }

    public function findAllProfilActif()
    {
        //récupère tous les profils actifs
        return Profil::where('status', Status::ACTIF)->get();
    }

    //récupération du profil
    public function findProfil(int $id)
    {
        return Profil::find($id);
    }

    public function update(Profil $profil, $data)
    {
        return $profil->update($data);
    }

}

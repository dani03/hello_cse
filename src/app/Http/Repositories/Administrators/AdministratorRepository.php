<?php

namespace App\Http\Repositories\Administrators;

use App\Enums\Status;
use App\Models\Administrateur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AdministratorRepository
{

    public function create(Collection $admin)
    {
        //creation de l'administrateur
        return Administrateur::create([
            'name' => $admin->get('name'),
            'email' => $admin->get('email'),
            'password' => Hash::make($admin->get('password')),

        ]);
    }

    public function findAdministratorByEmail(string $email)
    {
        return Administrateur::where('email', $email)->first();
    }

}

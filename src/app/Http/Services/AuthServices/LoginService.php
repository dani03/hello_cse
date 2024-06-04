<?php

namespace App\Http\Services\AuthServices;

use App\Http\Repositories\Administrators\AdministratorRepository;

class LoginService
{
    public function __construct(private AdministratorRepository $administratorRepository)
    {
    }

    public function logIn(string $email)
    {
        return $this->administratorRepository->findAdministratorByEmail($email);
    }


}

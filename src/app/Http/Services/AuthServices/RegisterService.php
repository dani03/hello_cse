<?php

namespace App\Http\Services\AuthServices;


use App\Http\Repositories\Administrators\AdministratorRepository;
use App\Http\Requests\RegisterRequest;

class RegisterService
{
    public function __construct(private AdministratorRepository $administratorRepository)
    {
    }

    public function createNewAdministrator(RegisterRequest $request) {
        // service permettant la creation de nouvel administrateur
        $data = collect($request->all());
       return  $this->administratorRepository->create($data);

    }

}

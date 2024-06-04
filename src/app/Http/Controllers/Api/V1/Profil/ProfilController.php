<?php

namespace App\Http\Controllers\Api\V1\Profil;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProfileRequest;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProfileRequest $request)
    {
        //on renvoie les données au service qui est chargé d'effectuer les transformations si nécessaire
        return $request->all();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

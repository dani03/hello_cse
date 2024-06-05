<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Profil\ProfilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//routes sans authentification
Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::get('profils', [ProfilController::class, 'index']);

//groupes de routes avec authentification
Route::middleware('auth:sanctum')->group(function () {
    Route::post('store/profil', [ProfilController::class, 'store']);
    Route::post('update/profil/{id}', [ProfilController::class, 'update']);
    Route::delete('delete/profil/{id}', [ProfilController::class, 'destroy']);
});

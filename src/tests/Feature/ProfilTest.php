<?php

namespace Tests\Feature;

use App\Enums\Status;
use App\Models\Administrateur;
use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProfilTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_profil(): void
    {
        $admin = Administrateur::factory()->create();
        //creation d'une fausse image
        $pathFile = fake()->image(storage_path('app/images'), 640, 480, null, false);
        $uploadedFile = new UploadedFile(
            storage_path('app/images') . '/' . $pathFile,
            $pathFile,
            'image/jpeg',
            null,
            true
        );

        $profil = [
            "nom" => fake()->name,
            "prenom" => fake()->firstName(),
            "image" => $uploadedFile,
            "status" => random_int(Status::INACTIF->value, Status::ACTIF->value)
        ];

        $response = $this->actingAs($admin)->postJson('api/v1/store/profil', $profil);
        $response->assertStatus(201);


    }

    public function test_user_can_get_all_profil_when_not_authenticate_without_status() : void
    {
        $response = $this->getJson('api/v1/profils');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'nom',
                'prenom',
                'image',
                'created_at',
                'updated_at',

            ]
        ]);
    }

    public function test_user_can_get_all_profil_when_authenticate_with_status() : void
    {
        $admin = Administrateur::factory()->create();

        $response = $this->actingAs($admin)->getJson('api/v1/profils');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'nom',
                'prenom',
                'image',
                'status',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function test_cannot_delete_profil_if_not_authenticate():void {
        $profil = Profil::factory()->create();
        $response = $this->deleteJson('api/v1/delete/profil/'.$profil->id);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
